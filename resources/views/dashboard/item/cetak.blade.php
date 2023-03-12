<style>
    table {border-collapse: collapse;}
    @media print 
    {
        @page
        {
            size:portrait;
        }
    }
    table
    {
        border-collapse : collapse;
    }
    .page {
        page-break-before: always;
    }
    .page:first-child {
        page-break-before: avoid;
    }
    .text-center{
        text-align:center;
        border:1px solid;
    }
</style>
<div class="page">
    <table width="100%">
        <tr>
            @php($no = 1)
            @foreach($lihat_items as $items)
                <td class="text-center">
                    <p>{{$items->nama_items}}</p>
                    <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($items->id_items.'-'.$items->nama_items.'-'.$items->sale_price_items, 'QRCODE')}}" alt="barcode" width="80px"/>
                    <br/>
                    <br/>
                    {{$items->kode_items}}
                </td>
                @if($no++ % 2 == 0)
                    <tr></tr>
                @endif
            @endforeach
        </tr>
    </table>
</div>
<script type="text/javascript">window.onload=function(){window.print();setTimeout(function(){window.close(window.location = "{{URL('dashboard/item')}}");}, 1);}</script>