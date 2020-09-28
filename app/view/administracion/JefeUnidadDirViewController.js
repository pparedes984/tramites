/*
 * File: app/view/administracion/JefeUnidadDirViewController.js
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

Ext.define('Tramites.view.administracion.JefeUnidadDirViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.administracion.jefeunidaddir',

    onCbUsuarioBuscar4Keyup: function(textfield, e, eOpts) {
        //carga los usuarios similares a lo que se esta escribiendo
        var txtUsuario = Ext.getCmp('cbUsuarioBuscar4').getValue();
        if(txtUsuario !== null && e.isSpecialKey() === false){//8 = Backspace
            var strUsuario = Ext.getCmp('cbUsuarioBuscar4').getStore();
            strUsuario.removeAll();
            Ext.Ajax.request({
                method: 'post',
                url: '../servidor/tramites/usuario/getUsuarioBusqueda',
                params: {
                    usuario: txtUsuario
                },
                success: function (response, options) {
                    strUsuario.load();
                    Ext.getCmp('cbUsuarioBuscar4').expand();
                }
            });
        }
    },

    onBtnLimpiarUsuarios4Click: function(button, e, eOpts) {
        Ext.getCmp('grdUsuarioJefe').getStore().removeAll();
        var strUsuario = Ext.getStore('Usuario');
        strUsuario.proxy.extraParams={
            usr: 0//carga todos los usuarios
        };
        strUsuario.load();
        Ext.getCmp('grdUnidadDir').getStore().removeAll();
        Ext.getCmp('cbUsuarioBuscar4').setValue(null);
    },

    onGrdUsuarioJefeRender: function(component, eOpts) {
        this.onBtnLimpiarUsuarios4Click();
    },

    onGrdUsuarioJefeItemClick: function(dataview, record, item, index, e, eOpts) {
        var g = Ext.getCmp('grdUsuarioJefe');
        var rec = g.selection;
        var txtusuario = rec.data.USR_USUARIO;
        /*var strParametro = Ext.getCmp('cbParametroUnidadDir').getStore();
        strParametro.proxy.extraParams = {
        usuario: txtusuario
        };
        strParametro.load();*/
        var strUnidad = Ext.getCmp('grdUnidadDir').getStore();
        strUnidad.removeAll();
        strUnidad.proxy.extraParams = {
            usuario: txtusuario,
            parametro: Ext.getCmp('cbParametroPrincipal').getValue()
        };
        strUnidad.load();
    },

    onBtnAgregarUnidadDirClick: function(button, e, eOpts) {
        var g = Ext.getCmp('grdUsuarioJefe');
        var arrayKeys = g.getSelectionModel().selected.items;
        var indice = g.getSelectionModel().selectionStartIdx;
        if(arrayKeys.length === 0){
            Ext.Msg.alert('Error', 'Debe escoger un usuario');
        }
        else
        {
            //crea una nueva línea en la grid
            var grid = Ext.getCmp('grdUnidadDir');
            var store = grid.getStore();
            var rec = g.selection;
            var usuariot = rec.data.USR_USUARIO;
            store.insert(0,
            {
                USR_USUARIO: usuariot,
                UND_PRM_ID: 0
            });
        }
    },

    onBtnQuitarUnidadDirClick: function(button, e, eOpts) {
        var g = Ext.getCmp('grdUsuarioJefe');
        var arrayKeys = g.getSelectionModel().selected.items;
        var indice = g.getSelectionModel().selectionStartIdx;
        if(arrayKeys.length === 0)
        Ext.Msg.alert('Error', 'Debe escoger un usuario');
        else
        {
            var grid = Ext.getCmp('grdUnidadDir');
            var arrayKeys = grid.getSelectionModel().selected.items;
            var indice = grid.getSelectionModel().selectionStartIdx;
            if(arrayKeys.length === 0)
            Ext.Msg.alert('Error', 'Debe escoger una unidad');
            else
            {
                var store = grid.getStore();
                var rec = grid.selection;
                var reco = g.selection;
                store.remove(rec);
                store.sync(
                {
                    params:{
                        usuario: reco.data.USR_USUARIO,
                        unidad: rec.data.UND_PRM_ID
                    },
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
        }
    },

    onCbUnidadDirExpand: function(field, eOpts) {
        var g = Ext.getCmp('grdUsuarioJefe');
        var rec = g.selection;
        var strUnidadDir = Ext.getCmp('cbUnidadDir').getStore();
        strUnidadDir.proxy.extraParams = {
            dir: 1,//devuelve las unidades de direccionamiento disponibles para el usuario para la asignacion de jefe
            usuario: rec.data.USR_USUARIO,
            parametro: Ext.getCmp('cbParametroPrincipal').getValue()
        };
        strUnidadDir.load();
    },

    onCbUnidadDirSelect: function(combo, record, eOpts) {
        ID_UND_PRM = record.data.UND_PRM_ID;
    },

    onRowEditingEdit: function(editor, context, eOpts) {
        var me = this;
        if (context.record.modified)
        {
            var store = Ext.getCmp('grdUnidadDir').getStore();
            var reco = context.record;
            store.add(reco);
            store.sync(
            {
                params:{
                    usuario: reco.data.USR_USUARIO,
                    ide: ID_UND_PRM
                },
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

    onGrdUnidadDirCellDblClick: function(tableview, td, cellIndex, record, tr, rowIndex, e, eOpts) {
        if(record.data.UND_PRM_ID === 0)
        Ext.getCmp('cbUnidadDir').setDisabled(false);
        else
        Ext.getCmp('cbUnidadDir').setDisabled(true);
    }

});
