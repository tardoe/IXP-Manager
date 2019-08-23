<?php

namespace IXP\Http\Controllers\Interfaces;

/*
 * Copyright (C) 2009 - 2019 Internet Neutral Exchange Association Company Limited By Guarantee.
 * All Rights Reserved.
 *
 * This file is part of IXP Manager.
 *
 * IXP Manager is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the Free
 * Software Foundation, version v2.0 of the License.
 *
 * IXP Manager is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for
 * more details.
 *
 * You should have received a copy of the GNU General Public License v2.0
 * along with IXP Manager.  If not, see:
 *
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

use D2EM, Input, Log, Redirect;

use Entities\{
    CoreBundle as CoreBundleEntity,
    CoreLink as CoreLinkEntity,
    CoreInterface as CoreInterfaceEntity,
    SwitchPort as SwitchPortEntity,
    VirtualInterface as VirtualInterfaceEntity,
};

use Illuminate\Http\{
    JsonResponse,
    RedirectResponse,
    Request
};

use IXP\Http\Requests\{
    StoreCoreBundle
};

use IXP\Utils\View\Alert\Alert;
use IXP\Utils\View\Alert\Container as AlertContainer;

/**
 * Core Link Controller
 * @author     Barry O'Donovan <barry@islandbridgenetworks.ie>
 * @author     Yann Robin <yann@islandbridgenetworks.ie>
 * @category   Interfaces
 * @copyright  Copyright (C) 2009 - 2019 Internet Neutral Exchange Association Company Limited By Guarantee
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU GPL V2.0
 */
class CoreLinkController extends Common
{
    public function __construct()
    {
        if( !config( 'ixp_fe.frontend.beta.core_bundles', false ) ) {
            AlertContainer::push( 'The core bundle functionality is not ready for production use.', Alert::DANGER );
            Redirect::to('')->send();
        }
    }

    /**
     * Add a core link to a core bundle only when EDITING a core bundle
     *
     * @param   Request $request instance of the current HTTP request
     *
     * @return  RedirectResponse
     *
     * @throws
     */
    public function add( Request $request ): RedirectResponse
    {
        /** @var CoreBundleEntity $cb */
        if( !( $cb = D2EM::getRepository( CoreBundleEntity::class )->find( $request->input( 'core-bundle' ) ) ) ) {
            abort('404', 'Unknown Core Bundle');
        }

        if( $request->input( 'nb-core-links' ) == 0 || $request->input( 'nb-core-links' ) == null ){
            return Redirect::to( route( "core-bundle@edit", [ "id" => $cb->getId()] ) )->withInput( Input::all() );
        }

        $this->buildCorelink( $cb, $request, [ 'a' => $cb->getVirtualInterfaces()[ 'A' ] , 'b' =>  $cb->getVirtualInterfaces()[ 'B' ] ], 1 , true );

        D2EM::flush();

        Log::notice( $request->user()->getUsername() . ' added a core link for the core bundle with (id: ' . $cb->getId() . ')' );

        AlertContainer::push( 'Core link added.', Alert::SUCCESS );

        return Redirect::to( route( "core-bundle@edit" , [ "id" => $cb->getId() ] ) );
    }

    /**
     * Edit the core links associated to a core bundle
     *
     * @param   Request $request instance of the current HTTP request
     *
     * @param   int $id ID of the core bundle
     *
     * @return  RedirectResponse
     *
     * @throws
     */
    public function store( Request $request, int $id ): RedirectResponse {
        /** @var CoreBundleEntity $cb */
        if( !( $cb = D2EM::getRepository( CoreBundleEntity::class )->find( $id ) ) ) {
            abort('404', 'Unknown Core bundle');
        }

        foreach( $cb->getCoreLinks() as $cl ){
            /** @var CoreLinkEntity $cl */
            $cl->setEnabled( $request->input( 'enabled-'.$cl->getId() ) ?? false );

            if( $cb->isECMP() ){
                $cl->setBFD( $request->input( 'bfd-'.$cl->getId() ) ?? false  );
                $cl->setIPv4Subnet( $request->input( 'subnet-'.$cl->getId() ) );
            }
        }

        D2EM::flush();

        Log::notice( $request->user()->getUsername() . ' edited the core links from the core bundle with (id: ' . $cb->getId() . ')' );

        AlertContainer::push( 'Core links edited.', Alert::SUCCESS );

        return Redirect::to( route( "core-bundle@edit", [ "id" => $cb->getId() ] ) );

    }

    /**
     * Display the form to add a core link to the bundle core form
     *
     * @param  Request    $request        instance of the current HTTP request
     *
     * @return JsonResponse
     *
     * @throws
     */
    public function addCoreLinkFrag( Request $request ) :JsonResponse
    {
        $nb = $request->input("nbCoreLink") + 1;

        $returnHTML = view('interfaces/core-bundle/core-link-frag')->with([
            'nbLink'                        => $nb,
            'enabled'                       => $request->input("enabled" ) ? true : false,
            'bundleType'                    => array_key_exists( $request->input("bundleType" ), CoreBundleEntity::$TYPES ) ? $request->input("bundleType" ) : CoreBundleEntity::TYPE_ECMP ,
        ])->render();

        return response()->json( ['success' => true, 'htmlFrag' => $returnHTML, 'nbCoreLinks' => $nb ] );
    }


    /**
     * Delete a Core link
     *
     * Delete the associated core interface/ physical interface
     * Change the type of the switch ports to UNSET
     *
     * @param  Request $request
     *
     * @return  RedirectResponse
     *
     * @throws
     */
    public function delete( Request $request ) : RedirectResponse {

        /** @var CoreLinkEntity $cl */
        if( !( $cl = D2EM::getRepository( CoreLinkEntity::class )->find( $request->input( "id" ) ) ) ) {
            abort( 404 );
        }

        $cb = $cl->getCoreBundle();

        foreach( $cl->getCoreInterfaces() as $ci ){
            /** @var CoreInterfaceEntity $ci */
            $pi = $ci->getPhysicalInterface();
            $sp = $pi->getSwitchPort();

            $sp->setType( SwitchPortEntity::TYPE_UNSET );

            D2EM::remove( $pi );
            D2EM::remove( $ci );
        }
        
        D2EM::remove( $cl );
        D2EM::flush();

        Log::notice( $request->user()->getUsername()." deleted a core link (id: " . $request->input( 'id' ) . ')' );

        AlertContainer::push( 'Core link deleted.', Alert::SUCCESS );

        return Redirect::to( route( "core-bundle@edit", [ "id" => $cb->getId() ] ) );
    }
}