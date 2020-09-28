/*
 * File: app/view/consultar/winTramite.js
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

Ext.define('Tramites.view.consultar.winTramite', {
    extend: 'Ext.window.Window',
    alias: 'widget.consultar.wintramite',

    requires: [
        'Tramites.view.consultar.winTramiteViewModel',
        'Tramites.view.consultar.winTramiteViewController',
        'Ext.form.Panel',
        'Ext.form.field.Display',
        'Ext.form.field.Checkbox',
        'Ext.form.field.TextArea',
        'Ext.form.Label',
        'Ext.form.field.Date'
    ],

    controller: 'consultar.wintramite',
    viewModel: {
        type: 'consultar.wintramite'
    },
    height: 650,
    scrollable: true,
    width: 763,
    constrainHeader: true,
    title: 'Informacion de Trámite',

    layout: {
        type: 'vbox',
        align: 'stretch'
    },
    items: [
        {
            xtype: 'panel',
            margin: '5 0 0 0',
            width: 455,
            layout: 'center'
        },
        {
            xtype: 'form',
            reference: 'form',
            height: 538,
            id: 'frmConsultarTramite',
            scrollable: true,
            width: 600,
            layout: 'column',
            bodyPadding: 10,
            title: '',
            items: [
                {
                    xtype: 'panel',
                    height: 728,
                    id: 'pnlCol1',
                    margin: '0 15 0 0',
                    items: [
                        {
                            xtype: 'displayfield',
                            modal: true,
                            id: 'dspTraCodigo',
                            width: 180,
                            fieldLabel: 'Número de trámite',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_CODIGO'
                        },
                        {
                            xtype: 'displayfield',
                            width: 274,
                            fieldLabel: 'Fecha',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_FECHA'
                        },
                        {
                            xtype: 'checkboxfield',
                            disabled: true,
                            fieldLabel: 'Recibido',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_RECIBIDO'
                        },
                        {
                            xtype: 'displayfield',
                            width: 271,
                            fieldLabel: 'N° de Oficio',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_OFICIO'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Beneficiario',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_BENEFICIARIO1'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Cedula',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_CEDULA1'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Beneficiario 2',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_BENEFICIARIO2'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Cedula 2',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_CEDULA2'
                        },
                        {
                            xtype: 'displayfield',
                            width: 315,
                            fieldLabel: 'Proyecto / Partida Presupuestaria',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_PROYECTO'
                        },
                        {
                            xtype: 'displayfield',
                            width: 317,
                            fieldLabel: 'Unidad de Gasto',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_GASTO'
                        },
                        {
                            xtype: 'textareafield',
                            width: 340,
                            fieldLabel: 'Descripcion',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_DESCRIPCION',
                            editable: false
                        },
                        {
                            xtype: 'checkboxfield',
                            disabled: true,
                            fieldLabel: 'Anulado',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_ANULADO'
                        }
                    ]
                },
                {
                    xtype: 'panel',
                    id: 'pnlCOl2',
                    items: [
                        {
                            xtype: 'displayfield',
                            width: 219,
                            fieldLabel: 'Unidad Solicitante',
                            labelStyle: 'font-weight:bold;',
                            name: 'UND_NOMBRE'
                        },
                        {
                            xtype: 'displayfield',
                            width: 271,
                            fieldLabel: 'Asunto',
                            labelStyle: 'font-weight:bold;',
                            name: 'ASU_DESCRIPCION'
                        },
                        {
                            xtype: 'displayfield',
                            width: 247,
                            fieldLabel: 'Parámetro',
                            labelStyle: 'font-weight:bold;',
                            name: 'PRM_NOMBRE'
                        },
                        {
                            xtype: 'displayfield',
                            width: 280,
                            fieldLabel: 'Fecha de Recibido',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_FECHARECIBIDO'
                        },
                        {
                            xtype: 'displayfield',
                            width: 189,
                            fieldLabel: 'Reserva',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_COMPROMISO'
                        },
                        {
                            xtype: 'displayfield',
                            width: 189,
                            fieldLabel: 'Posición',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_POSICION',
                            value: ''
                        },
                        {
                            xtype: 'displayfield',
                            width: 305,
                            fieldLabel: 'Persona que Autoriza',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_PERSONA_AUTORIZA'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Teléfono/Ext',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_TELEFONO'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Valor',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_VALOR'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Detalle de Factura',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_DETALLE_FACTURA'
                        },
                        {
                            xtype: 'label',
                            text: 'Viáticos, si aplica:'
                        },
                        {
                            xtype: 'datefield',
                            border: 0,
                            style: 'border:0px;',
                            fieldLabel: 'Fecha de Viaje',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_FECHA_VIAJE_VIATICO',
                            readOnly: true,
                            format: 'Y-m-d'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Fecha fin de Viaje',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_FECHA_VIAJE_FIN_VIATICO'
                        },
                        {
                            xtype: 'displayfield',
                            fieldLabel: 'Destino',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_DESTINO_VIATICO'
                        },
                        {
                            xtype: 'textareafield',
                            width: 340,
                            fieldLabel: 'Personas Adicionales',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_PERSONAS_ADIC_VIATICO',
                            editable: false
                        },
                        {
                            xtype: 'textareafield',
                            width: 340,
                            fieldLabel: 'Observaciones de Viaje',
                            labelStyle: 'font-weight:bold;',
                            name: 'TRA_OBSERV_VIAJE_VIATICO',
                            editable: false
                        }
                    ]
                },
                {
                    xtype: 'container',
                    padding: 10,
                    layout: {
                        type: 'hbox',
                        align: 'middle',
                        pack: 'center'
                    }
                },
                {
                    xtype: 'container',
                    padding: 10,
                    layout: {
                        type: 'hbox',
                        align: 'middle',
                        pack: 'center'
                    }
                },
                {
                    xtype: 'container',
                    padding: 10,
                    layout: {
                        type: 'hbox',
                        align: 'middle',
                        pack: 'center'
                    }
                },
                {
                    xtype: 'container',
                    padding: 10,
                    layout: {
                        type: 'hbox',
                        align: 'middle',
                        pack: 'center'
                    }
                }
            ]
        }
    ],
    listeners: {
        afterrender: 'onWindowAfterRender'
    }

});