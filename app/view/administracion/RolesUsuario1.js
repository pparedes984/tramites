/*
 * File: app/view/administracion/RolesUsuario1.js
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

Ext.define('Tramites.view.administracion.RolesUsuario1', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.administracion.rolesusuario1',

    requires: [
        'Tramites.view.adminGeneral.RolesUsuarioViewModel2',
        'Tramites.view.adminGeneral.RolesUsuarioViewController2',
        'Ext.grid.Panel',
        'Ext.toolbar.Toolbar',
        'Ext.form.field.ComboBox',
        'Ext.button.Button',
        'Ext.view.Table',
        'Ext.grid.column.Column',
        'Ext.grid.plugin.RowEditing'
    ],

    controller: 'administracion.rolesusuario1',
    viewModel: {
        type: 'administracion.rolesusuario1'
    },
    cls: 'myCls',
    flex: 2,
    title: 'Asignación de Roles a Usuarios',
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
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdUsuarioRol1',
                    forceFit: true,
                    store: 'Usuario',
                    dockedItems: [
                        {
                            xtype: 'toolbar',
                            dock: 'top',
                            items: [
                                {
                                    xtype: 'combobox',
                                    id: 'cbUsuarioBuscar1',
                                    enableKeyEvents: true,
                                    hideTrigger: true,
                                    displayField: 'USR_USUARIO',
                                    queryMode: 'local',
                                    store: 'Usuario',
                                    valueField: 'USR_USUARIO',
                                    listeners: {
                                        keyup: 'onCbUsuarioBuscarKeyup',
                                        select: 'onCbUsuarioBuscarSelect'
                                    }
                                },
                                {
                                    xtype: 'button',
                                    id: 'btnLimpiarUsuario1',
                                    iconCls: 'x-fa fa-refresh',
                                    text: 'Limpiar',
                                    listeners: {
                                        click: 'onBtnLimpiarUsuarioClick'
                                    }
                                }
                            ]
                        }
                    ],
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            dataIndex: 'USR_CEDULA',
                            text: 'Cédula'
                        },
                        {
                            xtype: 'gridcolumn',
                            dataIndex: 'USR_USUARIO',
                            text: 'Usuario'
                        }
                    ],
                    listeners: {
                        render: 'onGrdUsuarioRolRender',
                        itemclick: 'onGrdUsuarioRolItemClick'
                    }
                }
            ]
        },
        {
            xtype: 'panel',
            cls: 'myCls2',
            flex: 1,
            layout: 'fit',
            title: 'Roles',
            titleAlign: 'center',
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'button',
                            hidden: true,
                            id: 'btnAgregarRol1',
                            iconCls: 'x-fa fa-plus',
                            listeners: {
                                click: 'onBtnAgregarRolClick'
                            }
                        },
                        {
                            xtype: 'button',
                            hidden: true,
                            id: 'btnQuitarRol1',
                            iconCls: 'x-fa fa-trash',
                            listeners: {
                                click: 'onBtnQuitarRolClick'
                            }
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdRol1',
                    forceFit: true,
                    store: 'RolUsuario',
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                if(view)
                                {
                                    var descripcion = record.data.ROL_ID;
                                    var combo = metaData.column.getEditor();
                                    var comboStore = Ext.getCmp('grdRol1').getStore();
                                    var indice = comboStore.findExact(combo.valueField, value);

                                    if (indice >= 0)
                                    return comboStore.getAt(indice).get(combo.displayField);
                                    else
                                    return descripcion;
                                }
                                else
                                return null;
                            },
                            id: 'cbRol1',
                            dataIndex: 'ROL_ID',
                            text: 'Rol',
                            editor: {
                                xtype: 'combobox',
                                id: 'cbRoles1',
                                allowBlank: false,
                                displayField: 'ROL_NOMBRE',
                                store: 'Roles',
                                valueField: 'ROL_ID'
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
                        celldblclick: 'onGrdRolCellDblClick'
                    }
                }
            ]
        }
    ]

});