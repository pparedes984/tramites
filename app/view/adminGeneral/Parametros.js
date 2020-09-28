/*
 * File: app/view/adminGeneral/Parametros.js
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

Ext.define('Tramites.view.adminGeneral.Parametros', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.admingeneral.parametros',

    requires: [
        'Tramites.view.adminGeneral.ParametrosViewModel',
        'Tramites.view.adminGeneral.ParametrosViewController',
        'Ext.toolbar.Toolbar',
        'Ext.button.Button',
        'Ext.grid.Panel',
        'Ext.form.field.Text',
        'Ext.grid.column.Check',
        'Ext.form.field.Checkbox',
        'Ext.view.Table',
        'Ext.grid.plugin.RowEditing'
    ],

    controller: 'admingeneral.parametros',
    viewModel: {
        type: 'admingeneral.parametros'
    },
    cls: 'myCls',
    title: 'Parámetros',
    titleAlign: 'center',

    items: [
        {
            xtype: 'panel',
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'button',
                            id: 'btnAgregarParametro',
                            iconCls: 'x-fa fa-plus',
                            text: 'Agregar',
                            listeners: {
                                click: 'onBtnAgregarParametroClick'
                            }
                        },
                        {
                            xtype: 'button',
                            id: 'btnLimpiarParametros',
                            iconCls: 'x-fa fa-refresh',
                            text: 'Limpiar',
                            listeners: {
                                click: 'onBtnLimpiarParametrosClick'
                            }
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdParametros',
                    forceFit: true,
                    store: 'Parametro',
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            align: 'center',
                            dataIndex: 'PRM_NOMBRE',
                            text: 'Parámetro',
                            editor: {
                                xtype: 'textfield'
                            }
                        },
                        {
                            xtype: 'checkcolumn',
                            disabled: true,
                            dataIndex: 'PRM_ACTIVO',
                            text: 'Activo',
                            editor: {
                                xtype: 'checkboxfield'
                            }
                        }
                    ],
                    viewConfig: {
                        height: 332
                    },
                    plugins: [
                        {
                            ptype: 'rowediting',
                            listeners: {
                                edit: 'onRowEditingEdit',
                                canceledit: 'onRowEditingCanceledit'
                            }
                        }
                    ],
                    listeners: {
                        render: 'onGridpanelRender'
                    }
                }
            ]
        }
    ]

});