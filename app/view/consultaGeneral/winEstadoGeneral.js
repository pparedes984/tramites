/*
 * File: app/view/consultaGeneral/winEstadoGeneral.js
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

Ext.define('Tramites.view.consultaGeneral.winEstadoGeneral', {
    extend: 'Ext.window.Window',
    alias: 'widget.consultageneral.winestadogeneral',

    requires: [
        'Tramites.view.consultar.winEstadoConsViewModel1',
        'Tramites.view.consultar.winEstadoConsViewController1',
        'Ext.grid.Panel',
        'Ext.grid.column.Date',
        'Ext.view.Table'
    ],

    controller: 'consultageneral.winestadogeneral',
    viewModel: {
        type: 'consultageneral.winestadogeneral'
    },
    modal: true,
    height: 316,
    width: 900,
    layout: 'fit',
    constrainHeader: true,
    title: 'Estados',

    items: [
        {
            xtype: 'gridpanel',
            id: 'grdEstadosCons1',
            forceFit: true,
            store: 'Estado',
            columns: [
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'UND_NOMBRE',
                    text: 'Destino'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'TIP_NOMBRE',
                    text: 'Estado'
                },
                {
                    xtype: 'datecolumn',
                    dataIndex: 'EST_FECHARECIBIDO',
                    text: 'Fecha de Ingreso',
                    format: 'Y-m-d H:i:s'
                },
                {
                    xtype: 'datecolumn',
                    dataIndex: 'EST_FECHAFIN',
                    text: 'Fecha de finalizacion',
                    format: 'Y-m-d H:i:s'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'EST_OBSERVACION',
                    text: 'Observacion'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'EST_ASIGNADO_A',
                    text: 'Asignado A'
                }
            ],
            listeners: {
                render: 'onGrdEstadosConsRender'
            }
        }
    ]

});