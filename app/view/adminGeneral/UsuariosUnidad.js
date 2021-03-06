/*
 * File: app/view/adminGeneral/UsuariosUnidad.js
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

Ext.define('Tramites.view.adminGeneral.UsuariosUnidad', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.admingeneral.usuariosunidad',

    requires: [
        'Tramites.view.adminGeneral.UsuariosUnidadViewModel',
        'Tramites.view.adminGeneral.UsuariosUnidadViewController',
        'Ext.toolbar.Toolbar',
        'Ext.form.field.ComboBox',
        'Ext.button.Button',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.grid.column.Column',
        'Ext.grid.plugin.RowEditing'
    ],

    controller: 'admingeneral.usuariosunidad',
    viewModel: {
        type: 'admingeneral.usuariosunidad'
    },
    cls: 'myCls',
    title: 'Asignación de usuarios a unidades',
    titleAlign: 'center',

    layout: {
        type: 'hbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'panel',
            flex: 1,
            cls: 'myCls2',
            flex: 1,
            scrollable: true,
            layout: 'fit',
            title: 'Usuarios',
            titleAlign: 'center',
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'combobox',
                            id: 'cbUsuarioBuscar3',
                            emptyText: 'Ingrese un Usuario',
                            enableKeyEvents: true,
                            hideTrigger: true,
                            displayField: 'USR_USUARIO',
                            queryMode: 'local',
                            store: 'Usuario',
                            valueField: 'USR_USUARIO',
                            listeners: {
                                keyup: 'onCbUsuarioBuscar3Keyup'
                            }
                        },
                        {
                            xtype: 'button',
                            id: 'btnLimpiarUsuarios3',
                            iconCls: 'x-fa fa-refresh',
                            listeners: {
                                click: 'onBtnLimpiarUsuarios3Click'
                            }
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdUsuarioUnidad',
                    forceFit: true,
                    store: 'Usuario',
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            align: 'center',
                            dataIndex: 'USR_CEDULA',
                            text: 'Cédula'
                        },
                        {
                            xtype: 'gridcolumn',
                            align: 'center',
                            dataIndex: 'USR_USUARIO',
                            text: 'Usuario'
                        }
                    ],
                    listeners: {
                        render: 'onGrdUsuarioUnidadRender',
                        select: 'onGrdUsuarioUnidadSelect'
                    }
                }
            ]
        },
        {
            xtype: 'panel',
            cls: 'myCls2',
            flex: 1,
            layout: 'fit',
            title: 'Unidad',
            titleAlign: 'center',
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'button',
                            id: 'btnAgregarUnidadUsuario',
                            iconCls: 'x-fa fa-plus',
                            listeners: {
                                click: 'onBtnAgregarUnidadUsuarioClick'
                            }
                        },
                        {
                            xtype: 'button',
                            id: 'btnQuitarUnidadUsuario',
                            iconCls: 'x-fa fa-trash',
                            listeners: {
                                click: 'onBtnQuitarUnidadUsuarioClick'
                            }
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdUnidades',
                    forceFit: true,
                    store: 'UsuarioUnidad',
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                if(view)
                                {
                                    var descripcion = record.data.UND_CODIGO;
                                    var combo = metaData.column.getEditor();
                                    var comboStore = Ext.getCmp('grdUnidades').getStore();
                                    var indice = comboStore.findExact(combo.valueField, value);

                                    if (indice >= 0)
                                    return comboStore.getAt(indice).get(combo.displayField);
                                    else
                                    return descripcion;
                                }
                                else
                                return null;
                            },
                            id: 'cbUnidades',
                            align: 'center',
                            dataIndex: 'UND_CODIGO',
                            text: 'Unidad',
                            editor: {
                                xtype: 'combobox',
                                id: 'cbUnidad',
                                displayField: 'UND_NOMBRE',
                                store: 'Unidad',
                                valueField: 'UND_CODIGO',
                                listeners: {
                                    expand: 'onCbUnidadExpand'
                                }
                            }
                        }
                    ],
                    plugins: [
                        {
                            ptype: 'rowediting',
                            listeners: {
                                edit: 'onRowEditingEdit'
                            }
                        }
                    ],
                    listeners: {
                        celldblclick: 'onGrdUnidadesCellDblClick'
                    }
                }
            ]
        }
    ]

});