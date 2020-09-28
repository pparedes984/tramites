/*
 * File: app/view/direccionar/winEstado.js
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

Ext.define('Tramites.view.direccionar.winEstado', {
    extend: 'Ext.window.Window',
    alias: 'widget.direccionar.winestado',

    requires: [
        'Tramites.view.direccionar.winEstadoViewModel',
        'Tramites.view.direccionar.winEstadoViewController',
        'Ext.grid.Panel',
        'Ext.view.Table',
        'Ext.grid.column.Date',
        'Ext.grid.column.Check'
    ],

    controller: 'direccionar.winestado',
    viewModel: {
        type: 'direccionar.winestado'
    },
    modal: true,
    autoShow: true,
    draggable: false,
    height: 290,
    width: 900,
    layout: 'fit',
    constrainHeader: true,
    title: 'Estados',
    expandOnShow: false,

    items: [
        {
            xtype: 'gridpanel',
            id: 'grdEstadoRevisar',
            scrollable: 'vertical',
            forceFit: true,
            store: 'Estado',
            viewConfig: {
                height: 250
            },
            columns: [
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'UND_NOMBRE',
                    text: 'Destino'
                },
                {
                    xtype: 'datecolumn',
                    dataIndex: 'EST_FECHARECIBIDO',
                    text: 'Fecha',
                    format: 'Y-m-d H:i:s'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'TIP_NOMBRE',
                    text: 'Estado'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'EST_OBSERVACION',
                    text: 'Observación'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'EST_DESCRIPCION',
                    text: 'Descripción de la unidad'
                },
                {
                    xtype: 'checkcolumn',
                    disabled: true,
                    hidden: true,
                    dataIndex: 'EST_REVISADO_UNIDAD',
                    text: 'Revisado'
                },
                {
                    xtype: 'gridcolumn',
                    dataIndex: 'EST_ASIGNADO_A',
                    text: 'Asignado A'
                },
                {
                    xtype: 'datecolumn',
                    dataIndex: 'EST_FECHAFIN',
                    text: 'Fecha de finalización',
                    format: 'Y-m-d H:i:s'
                }
            ],
            listeners: {
                render: 'onGrdEstadoRevisarRender'
            }
        }
    ],
    listeners: {
        close: 'onWindowClose'
    }

});