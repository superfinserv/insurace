 @extends($layout)
    @section('content')
    <main role="main">
		<section class="invest-long page-heading-h2">
            <div class="container invest-long-bg text-center">
            	<h2>Which variant of <span id="span-modal-name" style="color:#C52118;font-weight:600" ></span> do you have? </h2>
				<div id="VarientContainer"></div>
            </div>
        </section>
    </main>
	<style type="text/css">
		.variant a.Chevrolet-pro.br-all {
            padding: 15px 1px;
            cursor: pointer;
            margin: 18px 0px;
        }
        .col-md-2.col-sm-2.active {
		    box-shadow: 2px 3px 9px 5px #ccc;
		    transition: 0.5s;
		}
    </style>
@endsection