<div align="center">
	<h4><u>{{$lihat_items->nama_items}}</u></h4>
	<br/>
	<img src="data:image/png;base64,{{DNS2D::getBarcodePNG($lihat_items->id_items.'-'.$lihat_items->nama_items.'-'.$lihat_items->harga_items, 'QRCODE', 2, 2)}}" alt="barcode"/>
</div>
<script type="text/javascript">window.onload=function(){window.print();setTimeout(function(){window.close(window.location = "{{URL('dashboard/item')}}");}, 1);}</script>