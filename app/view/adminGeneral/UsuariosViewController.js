/*
 * File: app/view/adminGeneral/UsuariosViewController.js
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

Ext.define('Tramites.view.adminGeneral.UsuariosViewController', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.admingeneral.usuarios',

    onCbUsuariosKeyup: function(textfield, e, eOpts) {
        //carga los usuarios similares a lo que se esta escribiendo
        var txtUsuario = Ext.getCmp('cbUsuarios').getValue();
        if(txtUsuario !== null && e.isSpecialKey() === false){//8 = Backspace
            var strUsuario = Ext.getCmp('cbUsuarios').getStore();
            strUsuario.removeAll();
            Ext.Ajax.request({
                method: 'post',
                url: '../servidor/tramites/usuario/getUsuarioBusqueda',
                params: {
                    usuario: txtUsuario
                },
                success: function (response, options) {
                    strUsuario.load();
                    //Ext.getCmp('cbUsuarios').expand();
                }
            });
        }
    },

    onCbCedulaUsuarioKeyup: function(textfield, e, eOpts) {
        //carga las cédulas similares a lo que se esta escribiendo
        var txtUsuario = Ext.getCmp('cbCedulaUsuario').getValue();
        if(txtUsuario !== null && e.isSpecialKey() === false){
            var strUsuario = Ext.getCmp('cbCedulaUsuario').getStore();
            strUsuario.removeAll();
            Ext.Ajax.request({
                method: 'post',
                url: '../servidor/tramites/usuario/getBusquedaCedula',
                params: {
                    usuario: txtUsuario
                },
                success: function (response, options) {
                    strUsuario.load();
                    //Ext.getCmp('cbCedulaUsuario').expand();
                }
            });
        }
    },

    onBtnAgregarUsuarioClick: function(button, e, eOpts) {
        //crea una nueva línea en la grig
        var grid = Ext.getCmp('grdUsuariosCrud');
        var store = grid.getStore();
        store.insert(0,
        {
            USR_USUARIO: ' ',
            USR_CEDULA: '',
            USR_NOMBRE: '',
            USR_APELLIDO: ''
        });
        grid.scrollTo('top', 0);
    },

    onBtnLimpiarUsuariosClick: function(button, e, eOpts) {
        //Ext.getCmp('grdUsuariosCrud').getStore().removeAll();
        var strUsuario = Ext.getStore('Usuario');
        strUsuario.removeAll();
        strUsuario.proxy.extraParams={
            usr: 1//carga todos los usuarios
        };
        strUsuario.load();
        Ext.getCmp('cbUsuarios').setValue(null);
        Ext.getCmp('cbCedulaUsuario').setValue(null);
    },

    onTxtUsrCrudFocusenter: function(component, event, eOpts) {
        var usr = Ext.getCmp('txtUsrCrud').getValue();
        Ext.getCmp('txtUsrCrud').setValue(Ext.String.trim(usr));
    },

    onTxtUsrCrudFocusleave: function(component, event, eOpts) {
        var usr = Ext.getCmp('txtUsrCrud').getValue();
        Ext.getCmp('txtUsrCrud').setValue(Ext.String.trim(usr));
    },

    onRowEditingCanceledit: function(editor, context, eOpts) {
        this.onBtnLimpiarUsuariosClick();
    },

    onRowEditingEdit: function(editor, context, eOpts) {

        var me = this;
        var store = Ext.getCmp('grdUsuariosCrud').getStore();
        var save = 1;//el registro es nuevo
        if(Ext.getCmp('txtUsrCrud').isDisabled())
        save = 0;

        if (context.record.modified)
        {
            var reco = context.record;
            store.add(reco);
            store.sync(
            {
                params:{
                    usuario: reco.data.USR_USUARIO,
                    accion: save
                },
                success: function(batch, success)
                {
                    store.commitChanges();
                    Ext.Msg.alert('Datos Guardados', 'Los datos se han guardado con éxito');
                    var strUsuario = Ext.getStore('Usuario');
                    store.removeAll();
                    store.proxy.extraParams={
                        usr: 1
                    };
                    store.load();
                },

                failure: function(batch, success)
                {
                    Ext.Msg.alert('Error', 'Hubor un error');
                }
            });
        }
    },

    onGrdUsuariosCrudRender: function(component, eOpts) {
        this.onBtnLimpiarUsuariosClick();
    },

    onGrdUsuariosCrudCellDblClick: function(tableview, td, cellIndex, record, tr, rowIndex, e, eOpts) {
        if(record.data.USR_USUARIO === ' ')
        {
            Ext.getCmp('txtUsrCrud').setDisabled(false);
            Ext.getCmp('txtUsrCrud').focus(true);
            Ext.getCmp('txtUsrCrud').focus(false);
        }
        else
        Ext.getCmp('txtUsrCrud').setDisabled(true);
    }

});
