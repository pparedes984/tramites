/*
 * File: app/view/adminGeneral/UnidadViewController1.js
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

Ext.define('Tramites.view.adminGeneral.UnidadViewController1', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.admingeneral.unidadgasto',

    onCbUndGastoBusquedaKeyup: function(textfield, e, eOpts) {
        var txtUndGasto = Ext.getCmp('cbUndGastoBus').getValue();
        if(txtUndGasto !== null && e.isSpecialKey() === false){
            var strUndGasto = Ext.getCmp('cbUndGastoBus').getStore();
            strUndGasto.removeAll();
            strUndGasto.proxy.extraParams = {
                busqueda: 1,//Parametro para elegir el tipo de busqueda
                textounidad:txtUndGasto
            };
            strUndGasto.load();
            Ext.getCmp('cbUndGastoBus').expand();
        }
    },

    onBtnAgregarUnidadGastoClick: function(button, e, eOpts) {
        var grid = Ext.getCmp('grdUnidadesGasto');//crea nueva linea en la grid
        var store = grid.getStore();
        store.insert(0,
        {
            GST_ID: 0,
            GST_DESCRIPCION: ''
        });
    },

    onBtnLimpiarUnidadGastoClick: function(button, e, eOpts) {
        var strUndGasto = Ext.getCmp('grdUnidadesGasto').getStore();
        strUndGasto.removeAll();
        strUndGasto.proxy.extraParams = {
        };
        strUndGasto.load();

        Ext.getCmp('cbUndGastoBus').setValue(null);
    },

    onGrdUnidades2Render: function(component, eOpts) {
        this.onBtnLimpiarUnidadGastoClick();
    },

    onRowEditingEdit: function(editor, context, eOpts) {
        var me = this;
        if (context.record.modified)
        {
            var store = Ext.getCmp('grdUnidadesGasto').getStore();
            var reco = context.record;
            store.add(reco);
            store.sync(
            {
                success: function(batch, success)
                {
                    store.commitChanges();
                    store.load();
                },

                failure: function(batch, success)
                {
                    Ext.Msg.alert('Error', 'Hubor un error');
                }
            });
        }
    },

    onRowEditingCanceledit: function(editor, context, eOpts) {
        this.onBtnLimpiarUnidadGastoClick();
    }

});