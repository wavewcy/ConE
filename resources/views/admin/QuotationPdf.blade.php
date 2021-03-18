<html>
    <header>
        <title>pdf</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta http-equiv=”Content-Language” content=”th” />
        <link rel="stylesheet" type="text/css" href="css/util.css">
	    <link rel="stylesheet" type="text/css" href="css/main.css">

        <style>
            @font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: normal;
                src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
            }
            @font-face {
                font-family: 'THSarabunNew';
                font-style: normal;
                font-weight: bold;
                src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
            }
            @font-face {
                font-family: 'THSarabunNew';
                font-style: italic;
                font-weight: normal;
                src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
            }
            @font-face {
                font-family: 'THSarabunNew';
                font-style: italic;
                font-weight: bold;
                src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
            }

            body {
                font-family: "THSarabunNew";
            }
        </style>

    </header>

    <body>
        <div class="container">
            <table style="margin: 20px;">
                <tr>
                    <td>
                        <div class="logopdf">
                            <img src="images/icons/logo.png"  alt="IMG-LOGO" >
                        </div>
                    </td>

                    <td >
                        <div style="margin-left: 20px;">
                            <h2><b>บริษัท เชียงใหม่ เซ็นเตอร์ สตีล จำกัด</b></h2>
                            <h3>172 หมู่ 8 ต.หนองจ๊อม อ.สันทราย จ.เชียงใหม่</h3>
                            <h3>โทรศัพท์ 053-345436-7</h3>
                            <h3>แฟกซ์ 053-345437</h3>
                        </div>
                    </td>

                    <td valign="middle">
                        @if($orders[0]->oStatus=='คำสั่งซื้อสำเร็จแล้ว') 
                        <div style="margin-left: 80px; text-align:center;">
                            <h1 style="background-color: #bdbaba;" ><b>ใบเสร็จรับเงิน</b></h1>
                            <h3><b>RECEIPT</b></h3>
                        </div>
                        @else
                        <div style="margin-left: 80px; text-align:center;">
                            <h1 style="background-color: #bdbaba;" ><b>ใบเสนอราคา</b></h1>
                            <h3><b>QUOTATION</b></h3>
                        </div>
                        @endif
                    </td>
                </tr>
            </table>

            @foreach($orders as $order)
            <div>
                <div class="contentPdf">
                    <span><b>ชื่อ </b>&nbsp;&nbsp;{{$order->oShipName}}</span><br>
                    <span><b>ที่อยู่ </b>&nbsp;&nbsp;{{$order->oShipAddress}}</span><br>
                    <span><b>โทรศัพท์ </b>&nbsp;&nbsp;{{$order->oShipPhone}}</span>
                </div>

                <div class="contentPdfDate">
                    <span><b>วันที่/Date: </b>&nbsp;&nbsp;{{$order->oDateQ}}</span><br>
                    <span><b>เลขที่เอกสาร/No: </b>&nbsp;&nbsp;{{$order->oID}}</span><br>
                    <span><b>พนักงานขาย: </b>&nbsp;&nbsp;{{$saler}}</span>
                </div>
            </div>
            @endforeach

            <table class="quotation" >
                <tr>
                    <th style="width: 5%;">ลำดับ</th>
                    <th style="width: 65%;">รายการสินค้า</th>
                    <th>จำนวน</th>
                    <th>หน่วย</th>
                    <th>ราคาขาย</th>
                    <th>จำนวนเงิน</th>
                </tr>
                @foreach($details as $index =>$detail)
                <tr>
                    <td style="text-align: center;">{{$index+1}}</td>
                    <td>{{$detail->tName}} ({{$detail->pBrand}}) {{$detail->pSize}} {{$detail->pThick}}</td>
                    <td style="text-align: center;">{{$detail->dQuantity}}</td>
                    <td style="text-align: center;">{{$detail->pUnit}}</td>

                    @if($orders[0]->oStatus=='รอยืนยันใบเสนอราคา' 
                    or $orders[0]->oStatus=='รอชำระเงิน' 
                    or $orders[0]->oStatus=='กำลังตรวจสอบการชำระเงิน'
                    or $orders[0]->oStatus=='คำสั่งซื้อสำเร็จแล้ว')
                        <td style="text-align: right;"><?php echo (number_format($detail->dPrice)); ?></td>
                        <td style="text-align: right;"><?php echo (number_format(($detail->dQuantity)*($detail->dPrice))); ?></td>
                    @endif
                    @if($orders[0]->oStatus=='อยู่ในระหว่างการต่อรองราคา'
                     or ($orders[0]->oStatus=='รอยืนยันการต่อรองราคา') )
                        @foreach($bargains as $bargain)
                            @if($bargain->dID == $detail->dID)
                                <td style="text-align: right;"><?php echo (number_format($bargain->bPrice)); ?></td>
                                <td style="text-align: right;"><?php echo (number_format(($detail->dQuantity)*($bargain->bPrice))); ?></td>
                            @endif
                        @endforeach
                    @endif     
                </tr>
                @endforeach
            </table>

            <div>
                <div class="contentUnder1">
                    <span><b>เงื่อนไข:</b></span><br>
                    <span>** อาจมีการเปลี่ยนแปลงราคาโดยไม่ได้แจ้งให้ทราบล่วงหน้า</span><br>
                    <span>** เมื่อมีการยืนยันการสั่งซื้อทางบริษัทฯจะไม่รับเปลี่ยนหรือคืนสินค้าไม่ว่ากรณีใดๆทั้งสิ้น</span>
                </div>

                <div class="contentUnder2">
                    <table class="total">
                        <tr>
                        @if($orders[0]->oStatus=='รอยืนยันใบเสนอราคา' 
                        or $orders[0]->oStatus=='รอชำระเงิน' 
                        or $orders[0]->oStatus=='กำลังตรวจสอบการชำระเงิน'
                        or $orders[0]->oStatus=='คำสั่งซื้อสำเร็จแล้ว')
                        <td>
                            <span><b>ค่าขนส่ง </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;{{$orders[0]->oShipCost}}</b></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>จำนวนเงินรวมก่อนภาษี </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;<?php echo (number_format($orders[0]->oAmount)); ?></b></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span><b>VAT 7% </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;<?php echo (number_format($orders[0]->oVat)); ?></b></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>จำนวนเงินรวมทั้งสิ้น </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;<?php echo (number_format($orders[0]->oAmountVat)); ?></b></span>
                            </td>
                        </tr>
                        @endif
                        @if($orders[0]->oStatus=='อยู่ในระหว่างการต่อรองราคา' 
                        or $orders[0]->oStatus=='รอยืนยันการต่อรองราคา')
                        <td>
                            <span><b>ค่าขนส่ง </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;{{$orders[0]->oShipCost}}</b></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>จำนวนเงินรวมก่อนภาษี </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;<?php echo (number_format($amount)); ?></b></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                               <span><b>VAT 7% </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;<?php echo (number_format($vat)); ?></b></span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span><b>จำนวนเงินรวมทั้งสิ้น </b></span>
                            </td>
                            <td>
                                <span><b>&nbsp;&nbsp;<?php echo (number_format($amountVat)); ?></b></span>
                            </td>
                        </tr>
                        @endif
                    </table>
                </div>
            </div><br><br><br><br>

            <div>
                <div class="contentUnder3">
                    <span><b>หมายเหตุ: </b></span><br>
                    @foreach($outOfStock as $out)
                    <span style=" line-height: 11px;">* {{$out->tName}} ({{$out->pBrand}}) {{$out->pSize}} {{$out->pThick}} 
                        &nbsp;<b style="color: red;">*สินค้าหมด</b></span><br>
                    @endforeach

                    @foreach($orders as $order)
                        @if($order->oNote != null)
                            <span style=" line-height: 11px;">* {{$order->oNote}}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            
            <div>
                @foreach($orders as $order)
                <div class="contentUnder4">
                    @if($orders[0]->oStatus=='คำสั่งซื้อสำเร็จแล้ว') 
                        <span><b><u>ผู้รับเงิน</u></b></span><br>
                    @else
                        <span><b><u>ผู้เสนอราคา</u></b></span><br>
                    @endif
                       <span>{{$saler}}</span><br>
                       <span>พนักงานขาย</span><br>
                       <span style=" line-height: 10px;">วันที่ {{$order->oDateQ}}</span>

                </div>

                <div class="contentUnder5">
                       <span><b><u>สำหรับลูกค้า</u></b></span><br>
                       @if($orders[0]->oStatus=='คำสั่งซื้อสำเร็จแล้ว' || $orders[0]->oStatus=='รอชำระเงิน' || $orders[0]->oStatus=='กำลังตรวจสอบการชำระเงิน') 
                       <span>{{$orders[0]->oShipName}}</span><br>
                       <!-- <hr size=3> -->
                       <span>ผู้ชำระเงิน</span><br>
                       @else
                       <span style=" line-height: 27px;">__________________</span><br>
                       <!-- <hr size=3> -->
                       <span style=" line-height: 13px;">ผู้อนุมัติการสั่งซื้อ</span><br>
                       @endif
                       @if($orders[0]->oStatus=='คำสั่งซื้อสำเร็จแล้ว' || $orders[0]->oStatus=='รอชำระเงิน' || $orders[0]->oStatus=='กำลังตรวจสอบการชำระเงิน')
                       <!-- <span style=" line-height: 26px;">ผู้อนุมัติการสั่งซื้อ</span><br> -->
                       <!-- <span >ผู้อนุมัติการสั่งซื้อ</span><br> -->
                       <span style=" line-height: 10px;">วันที่ {{$order->oDateQ}}</span>
                       @else
                       <span style=" line-height: 10px;">วันที่ {{$day}}</span>
                       @endif
                </div>
                @endforeach
            </div>
            
        </div>
    </body>

</html>