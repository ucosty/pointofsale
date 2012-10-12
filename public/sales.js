$(function() {
	var saleSubtotal = 0;
	var saleItems = 0;
	var saleConfirmStage = false;
	var saleQueue = new Array();

	function addItemToQueue(item)
	{
		if(typeof($(item).attr("alt")) === 'undefined') return false;

		// Get the item's name and price
		var itemValue = parseFloat($(item).attr("data-value"));
		var itemName = $(item).attr("alt");

		$("#saleItemQueue").append('<li><a href="#" data-value="' + itemValue + '"><b>' + itemName + '</b> <span class="itemCost">($'+ itemValue.toFixed(2) + ')</span></a></li>');

		// Add the item cost to the queue subtotal
		saleSubtotal += itemValue;
		saleItems++;

		saleQueue.push(itemName + " $" + itemValue);

		// Update the subtotal display
		$("#subtotalCurrency").html(saleSubtotal.toFixed(2));

		// Hide the 'no items' message
		$("#saleNoItemsMessage").hide()
		$("#sidebar #total").removeClass("zero");
	}

	function updateChangeDue()
	{
		var cashReceivedValue = $("#cashReceived").val();
		var changeDueValue = cashReceivedValue - saleSubtotal;

		// Ensure negative symbol is on correct side of dollar sign
		if(changeDueValue >= 0) {
			$("#changeDue").val("$" + changeDueValue.toFixed(2));
		} else {
			changeDueValue = saleSubtotal - cashReceivedValue;
			$("#changeDue").val("-$" + changeDueValue.toFixed(2));
		}
	}

	function clearItemQueue()
	{
		saleSubtotal = 0;
		saleItems = 0;

		// Update the subtotal display
		$("#subtotalCurrency").html(saleSubtotal.toFixed(2));

		// Update the order form value
		$("#orderValue").val("$" + saleSubtotal.toFixed(2));
		updateChangeDue();

		$("#saleNoItemsMessage").show();
		$("#sidebar #total").addClass("zero");

		// Empty the item queue list
		$("#saleItemQueue").html("");

		saleQueue = [];
	}

	function openCheckoutPanel()
	{
		if(saleSubtotal > 0)
		{
			// Process the data for insertion into form
			$("#cashReceived").val("");
			$("#orderValue").val("$" + saleSubtotal.toFixed(2));
			updateChangeDue();

			$("#content .sale").hide();
			$("#content .confirmation").show();

			$("#cashReceived").focus();

			saleConfirmStage = true;
		}
	}

	function processPayment()
	{
		if($("#cashReceived").val() == '') return;
		
		var saleTotal = saleSubtotal * 100;
		var cashReceivedValue = $("#cashReceived").val() * 100;
		var changeDueValue = (cashReceivedValue - saleTotal);

		$.post('?url=sales/create&ajax', {'CashReceived': cashReceivedValue, 'Total': saleTotal, 'Change': changeDueValue}, function(data) {
			$("#orderSuccessAlert").show();
			$("#orderSuccessAlert").delay(400).fadeOut(1000);
		});

		clearItemQueue();
		$("#content .confirmation").hide();
		$("#content .sale").show();

		saleConfirmStage = false;
	}
	//
	// Add item to sale queue
	$(".sale ul li img").click(function() {
		addItemToQueue(this);
	});

	//
	// Remove item from sale queue
	$("#saleItemQueue li a").live("click", function() {
		saleSubtotal -= $(this).attr("data-value");
		saleItems--;

		// Update the subtotal display
		$("#subtotalCurrency").html(saleSubtotal.toFixed(2));

		// Update the order form value
		$("#orderValue").val("$" + saleSubtotal.toFixed(2));
		updateChangeDue();

		$(this).remove();

		if(saleItems == 0) {
			$("#saleNoItemsMessage").show();
			$("#sidebar #total").addClass("zero");
		}

		return false;
	});

	//
	// Open Checkout Panel
	$("#total").click(function() {
		openCheckoutPanel();
		return false;
	});


	//
	// Sale Confirmation Change Calculation
	$("#cashReceived").keyup(function() {
		updateChangeDue();

		if(saleConfirmStage && event.which == 13) {
			processPayment();
		}
	});

	$("body").keydown(function(event) {
		if(saleConfirmStage) return;

		keyCharacter = String.fromCharCode(event.which);
		if(keyCharacter >= 0 && keyCharacter <= 9)
		{
			$("#prod-" + keyCharacter).parent().addClass("active");
		}
	});

	$("body").keyup(function(event) {
		if(saleConfirmStage) return;

		keyCharacter = String.fromCharCode(event.which);

		$("#prod-" + keyCharacter).parent().removeClass("active");

		if(keyCharacter >= 0 && keyCharacter <= 9)
		{
			addItemToQueue("#prod-" + keyCharacter);
		}

		if(keyCharacter == 'C') {
			clearItemQueue();
		}

		if(event.which == 13) {
			if(saleConfirmStage) {
				return;
			}
			openCheckoutPanel();
		}
	});

	$("#paymentBack").click(function() {
		$("#content .confirmation").hide();
		$("#content .sale").show();
		
		saleConfirmStage = false;

		return false;
	});

	$("#paymentCancel").click(function() {
		$("#content .confirmation").hide();
		$("#content .sale").show();

		clearItemQueue();
		saleConfirmStage = false;

		return false;
	});

	$("#paymentConfirm").click(function() {
		processPayment();
		return false;
	});	
});