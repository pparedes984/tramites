/*
 * File: app/view/consultar/winFiltro.js
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

Ext.define('Tramites.view.consultar.winFiltro', {
    extend: 'Ext.window.Window',
    alias: 'widget.consultar.winfiltro',

    requires: [
        'Tramites.view.consultar.winFiltroViewModel',
        'Tramites.view.consultar.winFiltroViewController',
        'Ext.panel.Panel',
        'Ext.form.field.Date',
        'Ext.form.field.Number',
        'Ext.form.field.Checkbox',
        'Ext.form.field.ComboBox',
        'Ext.form.field.TextArea',
        'Ext.button.Button'
    ],

    controller: 'consultar.winfiltro',
    viewModel: {
        type: 'consultar.winfiltro'
    },
    height: 553,
    id: 'cFiltro',
    width: 410,
    title: 'Filtros',

    layout: {
        type: 'vbox',
        align: 'center'
    },
    items: [
        {
            xtype: 'panel',
            cls: 'myCls',
            scrollable: true,
            width: 322,
            title: '',
            items: [
                {
                    xtype: 'panel',
                    margin: '0 0 0 10',
                    items: [
                        {
                            xtype: 'panel',
                            title: '',
                            layout: {
                                type: 'hbox',
                                align: 'stretch'
                            },
                            items: [
                                {
                                    xtype: 'datefield',
                                    id: 'desdec',
                                    margin: '10 10 10 0',
                                    width: 140,
                                    fieldLabel: 'Desde',
                                    labelWidth: 40,
                                    format: 'Y-m-d'
                                },
                                {
                                    xtype: 'datefield',
                                    id: 'hastac',
                                    margin: '10 0 10 0',
                                    width: 140,
                                    fieldLabel: 'Hasta:',
                                    labelWidth: 40,
                                    format: 'Y-m-d'
                                }
                            ]
                        },
                        {
                            xtype: 'numberfield',
                            id: 'numCodTramite',
                            width: 300,
                            fieldLabel: 'Número de trámite',
                            labelWidth: 150,
                            emptyText: 'Ej: 1',
                            hideTrigger: true
                        },
                        {
                            xtype: 'panel',
                            layout: {
                                type: 'hbox',
                                align: 'stretch'
                            },
                            items: [
                                {
                                    xtype: 'checkboxfield',
                                    id: 'chbAnulados',
                                    fieldLabel: 'Anulados',
                                    boxLabel: ''
                                }
                            ]
                        },
                        {
                            xtype: 'textfield',
                            id: 'txtBenefCons',
                            width: 300,
                            fieldLabel: 'Beneficiario',
                            emptyText: 'Ingrese solo mayúsculas',
                            maskRe: /[A-Z\s]/
                        },
                        {
                            xtype: 'combobox',
                            hidden: true,
                            id: 'cbParamConsulta',
                            width: 300,
                            fieldLabel: 'Parametro',
                            editable: false,
                            emptyText: 'Seleccione un Parámetro',
                            displayField: 'PRM_NOMBRE',
                            store: 'Parametro',
                            valueField: 'PRM_ID',
                            listeners: {
                                expand: 'onCbParamConsultaExpand'
                            }
                        },
                        {
                            xtype: 'combobox',
                            id: 'cbUGastoCons',
                            width: 300,
                            fieldLabel: 'Unidad de Gasto',
                            emptyText: 'Ingrese una Unidad',
                            enableKeyEvents: true,
                            hideTrigger: true,
                            anyMatch: true,
                            displayField: 'GST_NOMBRE',
                            queryMode: 'local',
                            store: 'UnidadGasto',
                            typeAhead: true,
                            valueField: 'GST_NOMBRE'
                        },
                        {
                            xtype: 'textfield',
                            id: 'txtProyCons',
                            width: 300,
                            fieldLabel: 'Proyecto/ Partida presupuestaria',
                            labelWidth: 120,
                            emptyText: 'Ingrese un código'
                        },
                        {
                            xtype: 'combobox',
                            id: 'cbAsuntoCons',
                            width: 300,
                            fieldLabel: 'Asunto',
                            editable: false,
                            emptyText: 'Seleccione un Asunto',
                            anyMatch: true,
                            displayField: 'ASU_DESCRIPCION',
                            store: 'Asunto',
                            valueField: 'ASU_CODIGO'
                        },
                        {
                            xtype: 'textareafield',
                            id: 'txtDescCons',
                            width: 300,
                            fieldLabel: 'Descripción',
                            emptyText: 'Ingrese una descripción'
                        },
                        {
                            xtype: 'textfield',
                            id: 'txtOficioCons',
                            width: 246,
                            fieldLabel: 'N° de Oficio',
                            emptyText: 'Ingrese el N° del oficio'
                        }
                    ]
                },
                {
                    xtype: 'container',
                    items: [
                        {
                            xtype: 'button',
                            id: 'btnBuscarCons',
                            margin: '0 0 0 30',
                            iconCls: 'x-fa fa-search',
                            text: 'Buscar',
                            listeners: {
                                click: 'onBtnBuscarConsClick'
                            }
                        },
                        {
                            xtype: 'button',
                            id: 'btnConsultarTodos',
                            margin: '0 0 0 20',
                            iconCls: 'x-fa fa-refresh',
                            text: 'Todos los Trámites',
                            listeners: {
                                click: 'onBtnConsultarTodosClick'
                            }
                        }
                    ]
                }
            ]
        }
    ]

});