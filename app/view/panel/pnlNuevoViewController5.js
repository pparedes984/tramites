/*
 * File: app/view/panel/pnlNuevoViewController5.js
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

Ext.define('Tramites.view.panel.pnlNuevoViewController5', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.panel.pnlconsultageneral',

    onTableCellDblClick: function(tableview, td, cellIndex, record, tr, rowIndex, e, eOpts) {
        if (record)
        {
            var winTramite = Ext.create('Tramites.view.consultaGeneral.winTramiteGeneral');
            winTramite.curRec = record;
            winTramite.store = Ext.getStore('Consulta1');
            Ext.getStore('Consulta1').load();
            winTramite.modal = true;
            winTramite.show();
        }
        else
        {
            Ext.Msg.alert('Error', 'Seleccione un registro para editar');
        }
    },

    onTableCellClick: function(tableview, td, cellIndex, record, tr, rowIndex, e, eOpts) {

        if(record.data.TRA_RECIBIDO!==true)
        Ext.getCmp('btnEstadosConsultar1').setDisabled(true);
        else
        Ext.getCmp('btnEstadosConsultar1').setDisabled(false);
    },

    onGrdConsulta1Render: function(component, eOpts) {
        //this.onBtnConsultarTodosClick();

        //Cargar combobox Unidad
        var strUnidad = Ext.getStore('Unidad');
        strUnidad.proxy.extraParams = {
            destino: 0,
        };
        strUnidad.load();





        var strConsulta1 = Ext.getStore('Consulta1');
        Ext.getCmp('grdConsulta2').getStore().removeAll();


        strConsulta1.proxy.extraParams = {
            busqueda: 3,//Parametro para elegir el tipo de busqueda
            codtramite:null,
            anulado: null,
            beneficiario: null,
            unidadsolicitante : null,
            //parametro: Ext.getCmp('cbParamConsulta1').getValue(),//cb Parametro de filtros
            parametro: null,//cb Parametro principal
            undgasto:  null,
            proyecto:  null,
            asunto:  null,
            descripcion:  null,
            noficio:  null,
            desde: null,
            hasta: null
        };
        strConsulta1.load();
    },

    onButtonClick: function(button, e, eOpts) {

        var winTramite = Ext.create('Tramites.view.consultaGeneral.winFiltro');
        winTramite.modal = true;
        winTramite.show();

    },

    onBtnEstadosConsultarClick: function(button, e, eOpts) {
        var grid = Ext.getCmp('grdConsulta2');
        var arrayKeys = grid.getSelectionModel().selected.items;
        var indice = grid.getSelectionModel().selectionStartIdx;
        var me =this;
        if(arrayKeys.length === 0)
        Ext.Msg.alert('Error', 'Debe escoger un registro');
        else
        {
            var winEstado = Ext.create('Tramites.view.consultaGeneral.winEstadoGeneral');
            winEstado.show();
        }
    }

});
