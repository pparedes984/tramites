/*
 * File: app/model/UsuarioUnidadParametroModel.js
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

Ext.define('Tramites.model.UsuarioUnidadParametroModel', {
    extend: 'Ext.data.Model',

    requires: [
        'Ext.data.field.String',
        'Ext.data.field.Integer'
    ],

    idProperty: 'UND_PRM_ID',

    fields: [
        {
            type: 'string',
            name: 'USR_USUARIO'
        },
        {
            type: 'int',
            name: 'UND_PRM_ID'
        },
        {
            type: 'int',
            name: 'UND_CODIGO'
        },
        {
            type: 'string',
            name: 'UND_NOMBRE'
        },
        {
            type: 'int',
            name: 'PRM_ID'
        },
        {
            type: 'string',
            name: 'UND_PRM'
        }
    ]
});