/*
 * File: app/view/panel/pnlNuevoViewController3.js
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

Ext.define('Tramites.view.panel.pnlNuevoViewController3', {
    extend: 'Ext.app.ViewController',
    alias: 'controller.panel.pnladmingeneral',

    onPnlUsuariosActivate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.Usuarios');
        this.getView().down('#pnlUsuarios').add(win);
        win.show();
    },

    onPnlParametrosActivate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.Parametros');
        this.getView().down('#pnlParametros').add(win);
        win.show();
    },

    onPnlAsuntos2Activate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.Asuntos');
        this.getView().down('#pnlAsuntos2').add(win);
        win.show();
    },

    onPnlUsrAParamActivate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.UsuarioParametro');
        this.getView().down('#pnlUsrAParam').add(win);
        win.show();
    },

    onPnlUsrXUnidadActivate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.UsuariosUnidad');
        this.getView().down('#pnlUsrXUnidad').add(win);
        win.show();
    },

    onPnlUnidadAdminActivate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.Unidad');
        this.getView().down('#pnlUnidadAdmin').add(win);
        win.show();
    },

    onPanelActivate: function(component, eOpts) {
        Ext.getCmp('pnlRolesUsuario').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.RolesUsuario');
        this.getView().down('#pnlRolesUsuario').add(win);
        win.show();
    },

    onPnlUndDirActivate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.UnidadDireccionamiento');
        this.getView().down('#pnlUndDir').add(win);
        win.show();
    },

    onPnlUndGastoActivate: function(component, eOpts) {
        Ext.getCmp('pnlParametros').removeAll();
        Ext.getCmp('pnlUsuarios').removeAll();
        Ext.getCmp('pnlAsuntos2').removeAll();
        Ext.getCmp('pnlUsrAParam').removeAll();
        Ext.getCmp('pnlUsrXUnidad').removeAll();
        Ext.getCmp('pnlUnidadAdmin').removeAll();
        Ext.getCmp('pnlUndDir').removeAll();
        Ext.getCmp('pnlUndGasto').removeAll();
        var win = Ext.create('Tramites.view.adminGeneral.UnidadGasto');
        this.getView().down('#pnlUndGasto').add(win);
        win.show();
    }

});
