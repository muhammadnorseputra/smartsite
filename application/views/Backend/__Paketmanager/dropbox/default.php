<div class="row m-b-15">

		<!-- Nav tabs -->
		<ul class="nav nav-tabs tab-nav-right tab-col-pink border-bottom" role="tablist">
			<li role="presentation" class=""><a href="#home" data-toggle="tab" aria-expanded="false">HOME</a></li>
			<li role="presentation" class="active"><a href="#profile" data-toggle="tab" aria-expanded="true">PROFILE</a></li>
			<li role="presentation" class=""><a href="#messages" data-toggle="tab" aria-expanded="false">MESSAGES</a></li>
			<li role="presentation" class=""><a href="#settings" data-toggle="tab" aria-expanded="false">SETTINGS</a></li>
		</ul>
</div>

		<!-- Tab panes -->
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade" id="home">
			<?php 
				$s = curl_init(); 
				curl_setopt($s,CURLOPT_URL,"https://api.planeupload.com/api/getFiles");
				curl_setopt($s,CURLOPT_HTTPHEADER,array("Accept: application/json",
				"Content-Type: application/json",
				"apiKey:QmZTaWNvc0FwcjZIdnc5aFh0eTNmTEdEZU5mbWVRMTBKRklmQ1liR1J0NG42MUt0cHU1bXBCVHZPdGYrcW93OVdpamJpQXhiWWxlWlVMbjhqbVVTanFMNFQ3Y1AxSUw0MDIrTXVsck40UFZDbVkva2JaYTFDbDFMdGcwOXZNcUdRQVJLcXFqYTJ6U0xvT3M4VDl6UnRnPT0=")); 
				curl_setopt($s, CURLOPT_POST, 1);
				curl_setopt($s, CURLOPT_POSTFIELDS, '{
				"page":"1",
				"limit":"10"
				}');
				curl_setopt($s, CURLOPT_RETURNTRANSFER, true);
				$out = curl_exec($s);
				curl_close($s);
				print_r($out);
				
			?>
			</div>
			<div role="tabpanel" class="tab-pane fade active in" id="profile">
				<b>Profile Content</b>
				<p>
					Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram
					moderatius.
					Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
					pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
					sadipscing mel.
				</p>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="messages">
				<b>Message Content</b>
				<p>
					Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram
					moderatius.
					Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
					pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
					sadipscing mel.
				</p>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="settings">
				<b>Settings Content</b>
				<p>
					Lorem ipsum dolor sit amet, ut duo atqui exerci dicunt, ius impedit mediocritatem an. Pri ut tation electram
					moderatius.
					Per te suavitate democritum. Duis nemore probatus ne quo, ad liber essent aliquid
					pro. Et eos nusquam accumsan, vide mentitum fabellas ne est, eu munere gubergren
					sadipscing mel.
				</p>
			</div>
		</div>