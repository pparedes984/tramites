/*
 * File: app/view/administracion/JefeUnidadDir.js
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

Ext.define('Tramites.view.administracion.JefeUnidadDir', {
    extend: 'Ext.panel.Panel',
    alias: 'widget.administracion.jefeunidaddir',

    requires: [
        'Tramites.view.administracion.JefeUnidadDirViewModel',
        'Tramites.view.administracion.JefeUnidadDirViewController',
        'Ext.toolbar.Toolbar',
        'Ext.form.field.ComboBox',
        'Ext.button.Button',
        'Ext.grid.Panel',
        'Ext.grid.column.Column',
        'Ext.view.Table',
        'Ext.grid.plugin.RowEditing'
    ],

    controller: 'administracion.jefeunidaddir',
    viewModel: {
        type: 'administracion.jefeunidaddir'
    },
    cls: 'myCls',
    title: 'Asignación de jefes a unidades de direccionamiento',
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
                            id: 'cbUsuarioBuscar4',
                            emptyText: 'Ingrese el usuario',
                            enableKeyEvents: true,
                            hideTrigger: true,
                            displayField: 'USR_USUARIO',
                            queryMode: 'local',
                            store: 'Usuario',
                            valueField: 'USR_USUARIO',
                            listeners: {
                                keyup: 'onCbUsuarioBuscar4Keyup'
                            }
                        },
                        {
                            xtype: 'button',
                            id: 'btnLimpiarUsuarios4',
                            iconCls: 'x-fa fa-refresh',
                            listeners: {
                                click: 'onBtnLimpiarUsuarios4Click'
                            }
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdUsuarioJefe',
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
                        render: 'onGrdUsuarioJefeRender',
                        itemclick: 'onGrdUsuarioJefeItemClick'
                    }
                }
            ]
        },
        {
            xtype: 'panel',
            cls: 'myCls2',
            flex: 1,
            layout: 'fit',
            title: 'Unidades de direccionamiento',
            titleAlign: 'center',
            dockedItems: [
                {
                    xtype: 'toolbar',
                    dock: 'top',
                    items: [
                        {
                            xtype: 'button',
                            id: 'btnAgregarUnidadDir',
                            iconCls: 'x-fa fa-plus',
                            listeners: {
                                click: 'onBtnAgregarUnidadDirClick'
                            }
                        },
                        {
                            xtype: 'button',
                            id: 'btnQuitarUnidadDir',
                            iconCls: 'x-fa fa-trash',
                            listeners: {
                                click: 'onBtnQuitarUnidadDirClick'
                            }
                        }
                    ]
                }
            ],
            items: [
                {
                    xtype: 'gridpanel',
                    id: 'grdUnidadDir',
                    forceFit: true,
                    store: 'UsuarioUnidadParametro',
                    columns: [
                        {
                            xtype: 'gridcolumn',
                            renderer: function(value, metaData, record, rowIndex, colIndex, store, view) {
                                if(view)
                                {
                                    var descripcion = record.data.UND_CODIGO;
                                    var combo = metaData.column.getEditor();
                                    var comboStore = Ext.getCmp('grdUnidadDir').getStore();
                                    var indice = comboStore.findExact(combo.valueField, value);

                                    if (indice >= 0)
                                    return comboStore.getAt(indice).get(combo.displayField);
                                    else
                                    return descripcion;
                                }
                                else
                                return null;
                            },
                            id: 'cbUnidadesDir',
                            align: 'center',
                            dataIndex: 'UND_PRM_ID',
                            text: 'Unidad',
                            editor: {
                                xtype: 'combobox',
                                id: 'cbUnidadDir',
                                displayField: 'UND_PRM',
                                store: 'UnidadParametro',
                                valueField: 'UND_PRM_ID',
                                listeners: {
                                    expand: 'onCbUnidadDirExpand',
                                    select: 'onCbUnidadDirSelect'
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
                        celldblclick: 'onGrdUnidadDirCellDblClick'
                    }
                }
            ]
        }
    ]

});