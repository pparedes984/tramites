/*
 * File: app/view/vwprtPrincipal.js
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

Ext.define('Tramites.view.vwprtPrincipal', {
    extend: 'Ext.container.Viewport',
    alias: 'widget.vwprtprincipal',

    requires: [
        'Tramites.view.vwprtPrincipalViewModel',
        'Tramites.view.vwprtPrincipalViewController',
        'Ext.panel.Panel',
        'Ext.toolbar.Toolbar',
        'Ext.form.field.ComboBox',
        'Ext.button.Button',
        'Ext.toolbar.Fill'
    ],

    controller: 'vwprtprincipal',
    viewModel: {
        type: 'vwprtprincipal'
    },
    height: 250,
    html: '<style> .myCls .x-panel-header-default {          background-color: #268581;} 	 .myCls2 .x-panel-header-default {         background-color: #268562; } </style>',
    style: 'background-color :  #666',
    width: 400,
    layout: 'fit',

    items: [
        {
            xtype: 'panel',
            layout: 'border',
            header: false,
            title: 'My Panel',
            items: [
                {
                    xtype: 'panel',
                    region: 'north',
                    height: 50,
                    html: '<center><img src="../servidor/img/banner-interno-sistra.jpg"></center>',
                    bodyStyle: 'background-color: #010047',
                    header: false,
                    title: 'My Panel'
                },
                {
                    xtype: 'panel',
                    region: 'center',
                    id: 'PanelCentral',
                    layout: 'fit',
                    header: false,
                    title: 'My Panel',
                    dockedItems: [
                        {
                            xtype: 'toolbar',
                            dock: 'top',
                            enableOverflow: true,
                            items: [
                                {
                                    xtype: 'combobox',
                                    id: 'cbParametroPrincipal',
                                    width: 172,
                                    fieldLabel: 'Parametro:',
                                    labelWidth: 65,
                                    editable: false,
                                    displayField: 'PRM_NOMBRE',
                                    store: 'Parametro',
                                    valueField: 'PRM_ID',
                                    listeners: {
                                        select: 'onCbParametroPrincipalSelect',
                                        expand: 'onCbParametroPrincipalExpand'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    id: 'btnNuevoTramite',
                                    iconAlign: 'right',
                                    iconCls: 'x-fa fa-plus',
                                    text: 'Nuevo',
                                    listeners: {
                                        click: 'onBtnNuevoTramiteClick'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    hidden: true,
                                    id: 'btnConsultaGeneral',
                                    iconAlign: 'right',
                                    iconCls: 'x-fa fa-search',
                                    text: 'Consulta General',
                                    listeners: {
                                        click: 'onBtnConsultaGeneralClick'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    id: 'btnConsultarTramite',
                                    iconAlign: 'right',
                                    iconCls: 'x-fa fa-info',
                                    text: 'Consultar',
                                    listeners: {
                                        click: 'onBtnConsultarTramiteClick'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    id: 'btnDireccionarTramite',
                                    iconAlign: 'right',
                                    iconCls: 'x-fa fa-arrow-right',
                                    text: 'Direccionar',
                                    listeners: {
                                        click: 'onBtnDireccionarTramiteClick'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    id: 'btnAdministrarTramite',
                                    iconAlign: 'right',
                                    iconCls: 'x-fa fa-cog',
                                    text: 'Administrar',
                                    listeners: {
                                        click: 'onBtnAdministrarTramiteClick'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    id: 'btnAdminGeneral',
                                    iconAlign: 'right',
                                    iconCls: 'fa fa-bolt',
                                    text: 'Admin General',
                                    listeners: {
                                        click: 'onBtnAdminGeneralClick'
                                    }
                                },
                                {
                                    xtype: 'tbfill'
                                },
                                {
                                    xtype: 'button',
                                    iconAlign: 'right',
                                    iconCls: 'fa fa-power-off',
                                    text: 'Salir',
                                    listeners: {
                                        click: 'onButtonSalirPClick'
                                    }
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ]

});