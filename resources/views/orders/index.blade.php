@extends('layouts.app')
@section('content')
    <div class="container-fluid">

            @livewire('order')
            
        <div class="modal">
            <div id="print">
                @include('reports.receipt');
            </div>
        </div>
@endsection
      <style>
       .modal.right .modal-dialog{
        top: 0;
        left: 0;
        margin-right: 19vh;
    }
    .modal.fade:not(.in).right .modal-dialog {
        -webkit-transform: translate3d(25%, 0, 0);
        transform: translate3d(25%, 0, 0);
    }
    .radio-item input[type="radio"]{
            visibility:hidden;
            width: 20px;
            height: 20px;
            margin: 0 5px 0 5px;
            padding: 0;
            cursor: pointer;

        }
        /*Before Styling*/

        .radio-item input[type="radio"]:before{
            position: relative;
            visibility:visible;
            width: 20px;
            height: 20px;
            margin: 4px -25px -4px 0;
            display: inline-block;
            border-radius: 10px;
            border: 2px inset rgb(150, 150, 150, 0.75);
            background: radial-gradient(ellipse at top left, rgb(255, 255, 255) 0%, rgb(250, 250,250) 5%, rgb(230, 230, 230) 95%, rgb(255, 255, 255)100%);
            content: '';
            cursor: pointer;

        }
        /*After Styling*/

        .radio-item input[type="radio"]:checked:after{
            position: relative;
            top: 0;
            left: 9px;
            display: inline-block;
            border-radius: 6px;
            visibility:visible;
            width: 12px;
            height: 12px;
            background: radial-gradient(ellipse at top left, rgb(240, 255, 220) 0%, rgb(225, 250, 100) 5%, rgb(75, 75, 0)95%, rgb(25, 100, 0) 100%);
            content: '';
            cursor: pointer;

        }
        /*After Checked*/
         .radio-item input[type="radio"].false:checked:after{
            background: radial-gradient(ellipse at top left, rgb(255, 255, 255) 0%, rgb(250, 250,250) 5%, rgb(230, 230, 230) 95%, rgb(255, 255, 255)100%);
         }
         /*After Checked value True*/
         .radio-item input[type="radio"].true:checked:after{
            background: radial-gradient(ellipse at top left, rgb(240, 255, 220) 0%, rgb(225, 250, 100) 5%, rgb(75, 75, 0)95%, rgb(25, 100, 0) 100%);

         }

         .radio-item label{
            display: inline-block;
            margin: 0;
            padding: 0;
            line-height: 25px;
            height: 25px;
            cursor: pointer;

         }






      </style>

@section('script')
    <script>
        // $ (document).ready(function(){
        //     alert(1);
        // })
        $( '.add_more').on('click',function(){
            var product = $('.product_id').html();
            var numberofrow = ($('.addMoreProduct tr').length-0)+1;
            var tr = '<tr><td class="no">'+ numberofrow + '</td>' + '<td><select class = "form-control product_id" name="product_id[]"> '+ product +
            ' </select></td>' +
            
            '<td> <input type="number" name="quantity[]" class = "form-control quantity"> </td>'+
            
            '<td> <input type="number" name="price[]" class = "form-control price"> </td>'+
            
            '<td> <input type="number" name="discount[]" class = "form-control discount"> </td>'+
            
            '<td> <input type="number" name="total_amount[]" class = "form-control total_amount"> </td>' +

            '<td> <a class = "btn btn-danger  btn-sm delete rounded-circle"><i class = "fa fa-times-circle"</a> </td>'

            $('.addMoreProduct').append(tr);
            
        });

        //Delete Section
        $('.addMoreProduct').delegate('.delete','click', function(){
            $(this).parent().parent().remove();
        });

        function TotalAmount(){
            var total= 0;
            $('.total_amount').each(function(i, e){
                var amount = $(this).val() - 0;
                total += amount;
            });

            $('.total').html(total);
        }

        $('.addMoreProduct').delegate('.product_id' , 'change', function(){
            var tr =$(this).parent().parent();
            var price = tr.find('.product_id option:selected').attr('data-price');
            tr.find('.price').val(price);
            var qty = tr.find('.quantity').val() - 0;
            var disc = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = (qty * price) -((qty * price * disc)/100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
        });

        $('.addMoreProduct').delegate('.quantity, .discount', 'keyup', function(){
            var tr =$(this).parent().parent();
            var qty = tr.find('.quantity').val() - 0;
            var disc = tr.find('.discount').val() - 0;
            var price = tr.find('.price').val() - 0;
            var total_amount = (qty * price) -((qty * price * disc)/100);
            tr.find('.total_amount').val(total_amount);
            TotalAmount();
             

        });

        $('#paid_amount').keyup(function(){
            var total = $('.total').html();
            var paid_amount = $(this).val();
            var tot = paid_amount - total;
            $('#balance').val(tot).toFixed(2);
        });

        // Print Receipt Section
        function PrintReceiptContent(el){
            var data = '<input type="button" id="printPageButton ' + 'class=" printPageButton" style="display: block; '+ 'width:100%; border: none; background-color: #008BBB; color:#fff '+'padding:14px 28px font-size:16px cursor:pointer; text-align:center" '+'value="Print Receipt"" onclick="window.print()">';
            data += document.getElementById(el).innerHTML;
            myReceipt = window.open("", "myWin", "left=150, top = 130, width = 400, height = 400" );
            myReceipt.screnx=0;
            myReceipt.screny=0;
            myReceipt.document.write(data);
            myReceipt.document.title="Print Receipt";
            myReceipt.focus();
            setTimeout(() => {
                myReceipt.close();
            }, 8000);

        }
    </script>
@endsection
