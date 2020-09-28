/*
 * File: app/view/administracion/AsuntosParametros.js
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

Ext.define('Tramites.view.administracion.AsuntosParametros', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.administracion.asuntosparametros',

    requires: [
        'Tramites.view.administracion.AsuntosParametrosViewModel1',
        'Tramites.view.administracion.AsuntosParametrosViewController1',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.grid.column.Column',
        'Ext.button.Button'
    ],

    controller: 'administracion.asuntosparametros',
    viewModel: {
        type: 'administracion.asuntosparametros'
    },
    cls: 'myCls',
    title: 'Asignación de Asuntos a parámetros',
    titleAlign: 'center',

    layout: {
        type: 'hbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'panel',
            flex: 1.25,
            cls: 'myCls2',
            flex: 1,
            id: 'pnlAsuntosNoAsig',
            layout: 'fit',
            title: 'Asuntos no Asignados',
            titleAlign: 'center',
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdAsuntosNoAsig',
                    forceFit: true,
                    store: 'Asunto',
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            align: 'center',
                            dataIndex: 'ASU_DESCRIPCION',
                            text: 'Asunto'
                        }
                    ]
                }
            ]
        },
        {
            xtype: 'panel',
            flex: 0.1,
            cls: 'myCls2',
            title: '|',
            titleAlign: 'center',
            layout: {
                type: 'vbox',
                align: 'center',
                pack: 'center'
            },
            items: [
                {
                    xtype: 'button',
                    id: 'btnRefreshAxP',
                    margin: '',
                    iconCls: 'x-fa fa-refresh',
                    text: '',
                    listeners: {
                        click: 'onBtnRefreshAxPClick'
                    }
                },
                {
                    xtype: 'button',
                    id: 'btnAsignar',
                    margin: '20 0 10 0',
                    iconCls: 'x-fa fa-arrow-right',
                    listeners: {
                        click: 'onBtnAsignarClick'
                    }
                },
                {
                    xtype: 'button',
                    id: 'btnQuitarAsignacion',
                    iconCls: 'x-fa fa-arrow-left',
                    listeners: {
                        click: 'onBtnQuitarAsignacionClick'
                    }
                }
            ]
        },
        {
            xtype: 'panel',
            flex: 1.25,
            cls: 'myCls2',
            flex: 1,
            id: 'pnlAsuntosAsig',
            layout: 'fit',
            title: 'Asuntos Asignados',
            titleAlign: 'center',
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdAsuntosAsig',
                    forceFit: true,
                    store: 'Asunto',
                    viewConfig: {
                        enableTextSelection: true
                    },
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            align: 'center',
                            dataIndex: 'ASU_DESCRIPCION',
                            text: 'Asunto'
                        }
                    ],
                    listeners: {
                        render: 'onGrdAsuntosAsigRender'
                    }
                }
            ]
        }
    ]

});