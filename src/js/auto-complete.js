var MIN_LENGTH = 2;

$( document ).ready(function() {
	$("#company").keyup(function() {
		var company = $("#company").val();
		if (company.length >= MIN_LENGTH) {

			$.get( "auto-completecompany.php", { company: company } )
			.done(function( data ) {
				$('#results').html('');
				var results = jQuery.parseJSON(data);
				$(results).each(function(key, value) {
					$('#results').append('<div class="item">' + value + '</div>');
				})

			    $('.item').click(function() {
			    	var text = $(this).html();
			    	$('#company').val(text);
			    })

			});
		} else {
			$('#results').html('');
		}
	});

    $("#company").blur(function(){
    		$("#results").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#results").show();
    	});

});

$( document ).ready(function() {
	$("#Emploi").keyup(function() {
		var keyword = $("#Emploi").val();
		if (keyword.length >= MIN_LENGTH) {

			$.get( "auto-complete.php", { keyword: keyword } )
			.done(function( data ) {
				$('#resultsEmploi').html('');
				var results = jQuery.parseJSON(data);
				$(results).each(function(key, value) {
					$('#resultsEmploi').append('<div class="itemEmploi">' + value + '</div>');
				})

			    $('.itemEmploi').click(function() {
			    	var text = $(this).html();
			    	$('#Emploi').val(text);
			    })

			});
		} else {
			$('#resultsEmploi').html('');
		}
	});

    $("#Emploi").blur(function(){
    		$("#resultsEmploi").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#resultsEmploi").show();
    	});

});
$( document ).ready(function() {
	$("#Regime").keyup(function() {
		var keyword = $("#Regime").val();
		if (keyword.length >= MIN_LENGTH) {

			$.get( "auto-complete.php", { keyword: keyword } )
			.done(function( data ) {
				$('#resultsRegime').html('');
				var results = jQuery.parseJSON(data);
				$(results).each(function(key, value) {
					$('#resultsRegime').append('<div class="itemRegime">' + value + '</div>');
				})

			    $('.item').click(function() {
			    	var text = $(this).html();
			    	$('#Regime').val(text);
			    })

			});
		} else {
			$('#resultsRegime').html('');
		}
	});

    $("#Regime").blur(function(){
    		$("#resultsRegime").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#resultsRegime").show();
    	});

});
$( document ).ready(function() {
	$("#Gouvernorat").keyup(function() {
		var keyword = $("#Gouvernorat").val();
		if (keyword.length >= MIN_LENGTH) {

			$.get( "auto-complete.php", { keyword: keyword } )
			.done(function( data ) {
				$('#resultsGouvernorat').html('');
				var results = jQuery.parseJSON(data);
				$(results).each(function(key, value) {
					$('#resultsGouvernorat').append('<div class="itemGouvernorat">' + value + '</div>');
				})

			    $('.item').click(function() {
			    	var text = $(this).html();
			    	$('#Gouvernorat').val(text);
			    })

			});
		} else {
			$('#resultsGouvernorat').html('');
		}
	});

    $("#Gouvernorat").blur(function(){
    		$("#resultsGouvernorat").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#resultsGouvernorat").show();
    	});

});
$( document ).ready(function() {
	$("#Produits").keyup(function() {
		var keyword = $("#Produits").val();
		if (keyword.length >= MIN_LENGTH) {

			$.get( "auto-complete.php", { keyword: keyword } )
			.done(function( data ) {
				$('#resultsProduits').html('');
				var results = jQuery.parseJSON(data);
				$(results).each(function(key, value) {
					$('#resultsProduits').append('<div class="itemProduits">' + value + '</div>');
				})

			    $('.item').click(function() {
			    	var text = $(this).html();
			    	$('#Produits').val(text);
			    })

			});
		} else {
			$('#resultsProduits').html('');
		}
	});

    $("#Produits").blur(function(){
    		$("#resultsProduits").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#resultsProduits").show();
    	});

});
$( document ).ready(function() {
	$("#branche").keyup(function() {
		var keyword = $("#branche").val();
		if (keyword.length >= MIN_LENGTH) {

			$.get( "auto-complete.php", { keyword: keyword } )
			.done(function( data ) {
				$('#resultsbranche').html('');
				var results = jQuery.parseJSON(data);
				$(results).each(function(key, value) {
					$('#resultsbranche').append('<div class="itembranche">' + value + '</div>');
				})

			    $('.item').click(function() {
			    	var text = $(this).html();
			    	$('#branche').val(text);
			    })

			});
		} else {
			$('#resultsbranche').html('');
		}
	});

    $("#branche").blur(function(){
    		$("#resultsbranche").fadeOut(500);
    	})
        .focus(function() {		
    	    $("#resultsbranche").show();
    	});

});
