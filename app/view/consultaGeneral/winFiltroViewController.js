/*
 * File: app/view/consultaGeneral/winFiltroViewController.js
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

Ext.define('Tramites.view.consultaGeneral.winFiltroViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.consultageneral.winfiltro',

    onCbParamConsultaExpand: function(field, eOpts) {
        var strParametroCons = Ext.getCmp('cbParamConsulta1').getStore();
        strParametroCons.proxy.extraParams={
            param:2
        };
        strParametroCons.load();
    },

    onBtnBuscarConsClick: function(button, e, eOpts) {
        var strConsulta1 = Ext.getStore('Consulta1');
        Ext.getCmp('grdConsulta2').getStore().removeAll();
        var chbanular = Ext.getCmp('chbAnulados1').getValue();
        if(chbanular === false)
        chbanular = null;

        strConsulta1.proxy.extraParams = {
            busqueda: 3,//Parametro para elegir el tipo de busqueda
            codtramite:Ext.getCmp('numCodTramite1').getValue(),
            anulado: chbanular,
            beneficiario: Ext.getCmp('txtBenefCons1').getValue(),
            unidadsolicitante : Ext.getCmp('cbUndSolicitante').getValue(),
            //parametro: Ext.getCmp('cbParamConsulta1').getValue(),//cb Parametro de filtros
            parametro: Ext.getCmp('cbParametroPrincipal').getValue(),//cb Parametro principal
            undgasto:  Ext.getCmp('cbUGastoCons1').getValue(),
            proyecto:  Ext.getCmp('txtProyCons1').getValue(),
            asunto:  Ext.getCmp('cbAsuntoCons1').getValue(),
            descripcion:  Ext.getCmp('txtDescCons1').getValue(),
            noficio:  Ext.getCmp('txtOficioCons1').getValue(),
            desde: Ext.getCmp('desdecg').getValue(),
            hasta: Ext.getCmp('hastacg').getValue()
        };
        strConsulta1.load();
        Ext.getCmp('cgFiltro').destroy();
    },

    onBtnConsultarTodosClick: function(button, e, eOpts) {
        var me = this;
        /*var strConsulta1 = Ext.getCmp('grdConsulta2').getStore();
        strConsulta1.removeAll();
        strConsulta1.proxy.extraParams = {
        busqueda : 2
        };
        strConsulta1.load();*/
        //Limpiar Filtros
        Ext.getCmp('numCodTramite1').setValue(null);
        Ext.getCmp('cbUndSolicitante').setValue(null);
        Ext.getCmp('chbAnulados1').setValue(null);
        Ext.getCmp('txtBenefCons1').setValue(null);
        Ext.getCmp('cbParamConsulta1').setValue(null);
        Ext.getCmp('cbUGastoCons1').setValue(null);
        Ext.getCmp('txtProyCons1').setValue(null);
        Ext.getCmp('cbAsuntoCons1').setValue(null);
        Ext.getCmp('txtDescCons1').setValue(null);
        Ext.getCmp('txtOficioCons1').setValue(null);
        Ext.getCmp('desdecg').setValue(null);
        Ext.getCmp('hastacg').setValue(null);

        me.onBtnBuscarConsClick();
    }

});