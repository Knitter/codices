/*
 * codices.js
 * 
 * Small book management software.
 * Copyright (C) 2016 Sérgio Lopes (knitter.is@gmail.com)
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>. 
 * (c) 2016 Sérgio Lopes
 */
"use strict";
(function (codices, $) {

    /**
     * 
     */
    codices.ajaxCreateAuthor = function (url) {
        var $modal = $('#newauthor');
        $.ajax($modal.find('form').attr('action'), {
            type: 'POST',
            dataType: 'json',
            data: {name: $modal.find('#author-name').val(), surname: $modal.find('#author-surname').val()}
        }).done(function (response) {
            //TODO: warn on error
            if (response.ok) {
                $('#book-authorid').html(response.html);
            }

            $modal.modal('hide');
            $modal.find('#author-name').val('');
            $modal.find('#author-surname').val('');
        });
    };

    /**
     * 
     */
    codices.ajaxCreateSeries = function () {
        var $modal = $('#newseries');
        $.ajax($modal.find('form').attr('action'), {
            type: 'POST',
            dataType: 'json',
            data: {name: $modal.find('#series-name').val(), author: $('#book-authorid').val()}
        }).done(function (response) {
            //TODO: warn on error
            if (response.ok) {
                $('#book-seriesid').html(response.html);
            }

            $modal.modal('hide');
            $modal.find('#series-name').val('');
        });
    };

    /**
     * 
     */
    codices.authorUpdated = function (url) {
        $.ajax(url, {
            type: 'GET',
            dataType: 'json',
            data: {id: $('#book-authorid').val()}
        }).done(function (response) {
            if (response.ok) {
                $('#book-seriesid').html(response.html);
            }
        });
    };
})(window.codices = window.codices || {}, jQuery);
