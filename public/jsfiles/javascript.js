$('body').on('click', '.add_product', function(){
    $('.product_form').trigger('reset');
    $('.modal-title').html('Add New Product');
    $('.save_btn').html('Save');
    $('#defaultModal').removeClass('hidden');
});
$('body').on('click', '#cros_btn', function(){
    $('#defaultModal').addClass('hidden');
});

$('body').on('click', '.product_edit', function(){
    $('#defaultModal').removeClass('hidden');
    $('.modal-title').html('Edit Product');
    $('.save_btn').html('Update');
    var id = $(this).data('id');
    $.ajax({
        url: 'manageproduct/edit/'+id

    }).done(function(res){
        $('#pid').val(res.product_id);
        $('#pname').val(res.product_name);
        $('#pprice').val(res.product_price);
        $('#pcolor').val(res.product_color);
        // $("#pimage").attr("src", res.product_image);
    });
});
$('body').on('click', '.product_delete', function(){
    var id = $(this).data('id');
    $.ajax({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'DELETE',
        url: 'manageproduct/delete/'+id
    }).done(function(res){
        $('.row_table_'+id).remove();
    });
});

$('body').on('click', '.buynow_btn', function(){
    var id  = $(this).data('id');
    $.ajax({
        url: 'order/card/'+id,
    }).done(function(res){
        $('.modal-title').html('Order Detail');
        $('.save_btn').html('proceed to Pay');
        $('#cardmodal').removeClass('hidden');
        $('#card_ptd').val(res.product_id);
        $('.card_image').attr("src", res.product_image);
        $('#cardpprice').val("Rs: "+res.product_price);
        $('#card_dfee').val('Rs: 100');
        var tamount = res.product_price + 100;
        $('#card_total_amount').val(tamount);
    });
    
});
$('body').on('click', '.cardpay_btn', function(e){
    e.preventDefault();
    $.ajax({
        url: '/order/store',
        type: 'POST',
        data: $('.card_form').serialize(),
    }).done(function(){
        $('#cardmodal').addClass('hidden');
        alert("Your Order Plassed Successfully");
    })

})
$('body').on('click', '#cros_btn', function(){
    $('#cardmodal').addClass('hidden');
});


$('body').on('click', '.approve_order', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/pendingorders/'+id
    }).done(function(){
        alert('Now This Order is Inprogress status');
        let route = 'pendingorders';
	    document.location.href = route;
    });
});

$('body').on('click', '.cancel_order', function(){
    var id = $(this).data('id');
    if (confirm('Are you sure you want to Cancle the Order!')) {
        $.ajax({
            url: '/pendingorders/cancel/'+id
        }).done(function(){
            alert('Now This Order is Canceled status');
            let route = 'pendingorders';
            document.location.href = route;
        });
    } else {
        
    } 
});

$('body').on('click', '.shipp_order', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/inprogressorders/'+id
    }).done(function(){
        alert('Now This Order is Shipped status');
        let route = 'inprogressorders';
	    document.location.href = route;
    });
});

$('body').on('click', '.deliver_order', function(){
    var id = $(this).data('id');
    $.ajax({
        url: '/deliveredorders/'+id
    }).done(function(){
        alert('Now This Order is Delivered status');
        let route = 'shippedorders';
	    document.location.href = route;
    });
});

$('body').on('click', '.nav_dropdown', function(){
    if($('#nav_dropdown_lists').hasClass('hidden')){
        $('#nav_dropdown_lists').removeClass('hidden');
        $('.nav_dropdown').addClass('focus:ring-white focus:ring-2 ')
    }else{
        $('#nav_dropdown_lists').addClass('hidden');
        $('.nav_dropdown').removeClass('focus:ring-white focus:ring-2 ')
    }
});


$('body').on('click', '.myorder_cancel', function(){
    var id = $(this).data('id');
    if (confirm('Are you sure you want to Cancle the Order!')) {
        $.ajax({
            url: '/myorder/cancel/'+id
        }).done(function(){
            alert('Your Order is Canceled Successfully');
            let route = 'myorders';
            document.location.href = route;
        });
    } else {
        
    } 
});

$('body').on('click', '.myorder_reorder', function(){
    var id = $(this).data('id');
    if (confirm('Are you sure you want to Re Order!')) {
        $.ajax({
            url: '/myorder/reorder/'+id
        }).done(function(){
            alert('You Re Order this Order Successfully');
            let route = 'myorders';
            document.location.href = route;
        });
    } else {
        
    } 
});


$('body').on('click', '#user_modal_cancel', function(){
    $('#user_modal_bg').addClass('hidden');
});

$('body').on('click', '#user_role_btn', function(){
    var id = $(this).data('id');
    $.ajax({
        url: 'manageusers/'+id
    }).done(function([res, roleres]){
        $('#uid').val(id);
        $('#uname').val(res.name);
        $('#uemail').val(res.email);
        $('#user_role_option').val(roleres);
    })
    $('#user_modal_bg').removeClass('hidden');
});

$('body').on('submit', '.edit_user_form', function(e){
    e.preventDefault();
    $.ajax({
        url:'manageusers',
        data: $('.edit_user_form').serialize(),
        type: 'POST'
    }).done(function(res){
        alert('User Edit Successfully');
        let route = 'manageusers';
        document.location.href = route;
    });
})



