/*
 * File: app/store/Usuario.js
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

Ext.define('Tramites.store.Usuario', {
    extend: 'Ext.data.Store',

    requires: [
        'Tramites.model.UsuarioModel',
        'Ext.data.proxy.Ajax',
        'Ext.data.reader.Json',
        'Ext.data.writer.Json'
    ],

    constructor: function(cfg) {
        var me = this;
        cfg = cfg || {};
        me.callParent([Ext.apply({
            storeId: 'Usuario',
            autoLoad: true,
            model: 'Tramites.model.UsuarioModel',
            proxy: {
                type: 'ajax',
                api: {
                    create: '../servidor/tramites/usuario/save',
                    read: '../servidor/tramites/usuario/get',
                    update: '../servidor/tramites/usuario/update',
                    destroy: '../servidor/tramites/usuario/delete'
                },
                actionMethods: {
                    create: 'POST',
                    read: 'POST',
                    update: 'POST',
                    destroy: 'POST'
                },
                reader: {
                    type: 'json',
                    rootProperty: 'data'
                },
                writer: {
                    type: 'json',
                    encode: true,
                    rootProperty: 'data'
                }
            }
        }, cfg)]);
    }
});