/*
 * File: app/view/administracion/AsuntosParametrosViewController3.js
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

Ext.define('Tramites.view.administracion.AsuntosParametrosViewController3', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.administracion.usuarioparametrobasico',

    onBtnRefreshUsxPBasicaClick: function(button, e, eOpts) {
        Ext.getCmp('grdUsuariosAsigBasica').getStore().removeAll();
        var strUsuario = Ext.getCmp('grdUsuariosAsigBasica').getStore();
        strUsuario.proxy.extraParams = {
            usr: 3,//carga todos los asignados al parametro
            parametro : Ext.getCmp('cbParametroPrincipal').getValue()
        };
        strUsuario.load();

        Ext.getCmp('grdUsuariosNoAsigBasica').getStore().removeAll();
        var strUsuario1 = Ext.getCmp('grdUsuariosNoAsigBasica').getStore();
        strUsuario1.proxy.extraParams = {
            parametro : Ext.getCmp('cbParametroPrincipal').getValue(),
            usr:4//carga todos los faltantes en el parametro
        };
        strUsuario1.load();
    },

    onBtnAsignarUsrXParamBasicaClick: function(button, e, eOpts) {
        var me = this;
        var grid = Ext.getCmp('grdUsuariosNoAsigBasica');
        var NoAsignadoarrayKeys = grid.getSelectionModel().selected.items;

        if(NoAsignadoarrayKeys.length === 0)
        Ext.Msg.alert('Error', 'Debe escoger un Usuario para asignar');

        else
        {
            var store = Ext.getStore('UsuarioParametro');
            store.add(Ext.getCmp('cbParametroPrincipal').getValue());
            store.sync(
            {
                params:{
                    usuario: NoAsignadoarrayKeys[0].data.USR_USUARIO,
                    parametro : Ext.getCmp('cbParametroPrincipal').getValue()
                },
                success: function(batch, success)
                {

                },

                failure: function(batch, success)
                {
                    Ext.Msg.alert('Error', 'Hubor un error');
                }
            });
            me.onBtnRefreshUsxPBasicaClick();
        }
    },

    onBtnQuitarUsrXParamBasicaClick: function(button, e, eOpts) {
        var me = this;
        var grid = Ext.getCmp('grdUsuariosAsigBasica');
        var AsignadoarrayKeys = grid.getSelectionModel().selected.items;
        if(AsignadoarrayKeys.length === 0)
        Ext.Msg.alert('Error', 'Debe escoger un Usuario a remover');
        else
        {
            var rec = grid.selection;
            Ext.Ajax.request
            (
            {
                method: 'post',
                url: '../servidor/tramites/usuarioparametro/delete',
                params: {
                    usuario: AsignadoarrayKeys[0].data.USR_USUARIO,
                    parametro: Ext.getCmp('cbParametroPrincipal').getValue()
                },
                success: function (response, options) {

                },
                failure: function (response, options){
                    Ext.Msg.alert('Error', 'Hubor un error');
                }
            }
            );
            me.onBtnRefreshUsxPBasicaClick();
        }
    },

    onGrdUsuariosAsigBasicaRender: function(component, eOpts) {
        var nuevoUsuario = Ext.create('Tramites.store.Usuario');
        Ext.getCmp('grdUsuariosAsigBasica').setStore(nuevoUsuario);
        this.onBtnRefreshUsxPBasicaClick();
    }

});
