import * as url from "url";

require('./bootstrap');

// Jquery kütüphanesinin tanımlanması
import $ from "jquery"



$(document).ready(function (){
    //item isteğini onaylayan işlem
    $(".accept").click(function (){
        let url = "/item/create";
        let thisElement = $(this);
        let dataId = $(this).attr('data-id');
        let data = {
            _token : token,
            id : dataId,
            is_request : true
        };

        $.get(url, data, function(response){
            console.log(response);
            if(response == "success"){
                console.log(thisElement.parent().parent().parent().addClass('hidden'));
                alertify.notify('Success', 'success', 3);
            }
        }, 'json');


        //console.log($(this).attr('data-id'));

    });
    //para isteğini onaylayan işlem
    $(".acceptMoney").click(function (){
        let url = "/confirmMoney/create";
        let thisElement = $(this);
        let dataId = $(this).attr('data-id');
        let data = {
            _token : token,
            id : dataId,
            is_request : true,
        };

        $.get(url, data, function(response){
            console.log(response);
            if(response == "success"){
                console.log(thisElement.parent().parent().parent().addClass('hidden'));
                alertify.notify('Success', 'success', 3);
            }
        }, 'json');


        //console.log($(this).attr('data-id'));

    });
    //para isteğini oluşturan işlem
    $("#addMoneyButton").click(function (){

        let amount = $('#addMoneyInput').val();
        let data = {
            data : amount,
            _token : token,
            user_id : user_id,
            is_request: true
        };

        $.post('/confirmMoney', data, function (resp){
           console.log(resp);
           if (resp == 'success'){
               alertify.notify('Success', 'success', 3);
           }
        });
    });
    //items sayfasındakki itemlerin satılık olmama durumunu ayarlar
    $(".not_sale").click(function (){
        //$(this).parent().find('.on_sale').addClass('hidden');
        //$(this).parent().find('.not_sale').removeClass('hidden');
        $(this).parent().parent().parent().find('.on_sale').toggleClass('hidden');
        $(this).parent().parent().parent().find('.not_sale').toggleClass('hidden');
        //$(this).toggleClass('flex');
        //$(this).toggleClass('hidden');

        let url = "/itemToggle";
        let dataId = $(this).parent().attr('data-id');
        let data = {
            _token: token,
            dataId: dataId,
            status: true
        };
        $.get(url, data, function (response){
            console.log(response);
        });
    });
    //items sayfasındakki itemlerin satılık olma durumunu ayarlar
    $(".on_sale").click(function (){
        $(this).parent().parent().parent().find('.on_sale').toggleClass('hidden');
        $(this).parent().parent().parent().find('.not_sale').toggleClass('hidden');
        //$(this).toggleClass('flex');
        //$(this).toggleClass('hidden');

        let url = "/itemToggle";
        let dataId = $(this).parent().attr('data-id');
        let data = {
            _token: token,
            dataId: dataId,
            status: false
        };
        $.get(url, data, function (response){
            console.log(response);
        });
    });
    //shop sayfasında ürün miktarı değiştikçe hesaplayıp çıktısını gösterme işlemi
    $(".priceCalcInput").keyup(function (){
        let url = "/calc";
        let thisElement = $(this);
        let dataId = $(this).parent().parent().parent().attr('data-id');
        let data = {
            _token : token,
            kind_id : dataId,
            quantity: thisElement.val(),
            is_request : true
        };
        if (data.quantity <= 0){
            return 0;
            thisElement.parent().parent().find('.calcResult').html("...");
        }
        $.get(url, data, function(response){
            console.log(response);
            thisElement.parent().parent().find('.calcResult').html("₺ "+response);
        }, 'json');
    });
    //shop sayfasında ürünün işlmelerini içeren kısmı açıp kapatma işlemi
    $(".item").click(function (){
        $(this).parent().find('.priceCalc').slideToggle('slow');
    });
    //shop sayfasında satın alma emrini verme işlemi
    $(".orderCreate").click(function (){

        let thisElement = $(this);
        let quantity = thisElement.parent().find('.priceCalcInput').val();

        alertify.confirm('Order Confirm', thisElement.parent().parent().find('.calcResult').text(), function (){
            alertify.warning('Working');
            let url = "/order";
            let dataId = thisElement.parent().parent().parent().attr('data-id');
            let data = {
                _token : token,
                kind_id : dataId,
                quantity: thisElement.parent().find('.priceCalcInput').val(),
                is_request : true
            };

            $.post(url, data, function(response){
                console.log(response);
                if(response[0] == 'success'){
                    alertify.notify('Success', 'success', 3);
                    if (response[1] != undefined){
                        thisElement.parent().parent().parent().parent().remove();
                        if (response[2] == 0){
                            $("#ItemsDiv").remove();
                        }
                    }
                }
                else if (response[0] == 'not_enough'){
                    alertify.notify('Insufficient balance','error',3);
                }
            }, 'json');
        } , function (){alertify.error('Denied')});


    });

});

import 'alpinejs'


