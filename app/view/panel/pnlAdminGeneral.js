/*
 * File: app/view/panel/pnlAdminGeneral.js
 *
 * This file was generated by Sencha Architect version 4.2.4.
 * http://www.sencha.com/products/architect/
 *
 * This file requires use of the Ext JS 6.5.x Classic library, under independent license.
 * License of Sencha Architect does not include license for Ext JS 6.5.x Classic. For more
 * details see http://www.sencha.com/license or contact license@sencha.com.
 *
 * This file will be auto-generated each and everytime you save your project.
 *
 * Do NOT hand edit this file.
 */

Ext.define('Tramites.view.panel.pnlAdminGeneral', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.panel.pnladmingeneral',

    requires: [
        'Tramites.view.panel.pnlNuevoViewModel3',
        'Tramites.view.panel.pnlNuevoViewController3',
        'Ext.tab.Panel',
        'Ext.tab.Tab'
    ],

    controller: 'panel.pnladmingeneral',
    viewModel: {
        type: 'panel.pnladmingeneral'
    },
    scrollable: true,
    layout: 'fit',
    title: 'Administración general',

    items: [
        {
            xtype: 'tabpanel',
            html: '<style> .myCls .x-panel-header-default {          background-color: #268581;} 	 .myCls2 .x-panel-header-default {         background-color: #268562; } </style>',
            activeTab: 0,
            items: [
                {
                    xtype: 'panel',
                    id: 'pnlUsuarios',
                    layout: 'fit',
                    title: 'Usuarios',
                    listeners: {
                        activate: 'onPnlUsuariosActivate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlParametros',
                    layout: 'fit',
                    title: 'Parámetros',
                    listeners: {
                        activate: 'onPnlParametrosActivate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlAsuntos2',
                    layout: 'fit',
                    title: 'Asuntos',
                    listeners: {
                        activate: 'onPnlAsuntos2Activate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlUsrAParam',
                    layout: 'fit',
                    title: 'Usuarios a parámetros',
                    listeners: {
                        activate: 'onPnlUsrAParamActivate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlUsrXUnidad',
                    layout: 'fit',
                    title: 'Usuarios a Unidades',
                    listeners: {
                        activate: 'onPnlUsrXUnidadActivate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlUnidadAdmin',
                    layout: 'fit',
                    title: 'Unidad',
                    listeners: {
                        activate: 'onPnlUnidadAdminActivate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlRolesUsuario',
                    layout: 'fit',
                    title: 'Roles a usuarios',
                    listeners: {
                        activate: 'onPanelActivate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlUndDir',
                    layout: 'fit',
                    title: 'Unidades de Direccionamiento',
                    listeners: {
                        activate: 'onPnlUndDirActivate'
                    }
                },
                {
                    xtype: 'panel',
                    id: 'pnlUndGasto',
                    layout: 'fit',
                    title: 'Unidades de Gasto',
                    listeners: {
                        activate: 'onPnlUndGastoActivate'
                    }
                }
            ]
        }
    ]

});