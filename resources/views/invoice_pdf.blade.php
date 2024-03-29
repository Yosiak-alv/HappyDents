<!DOCTYPE html>
<html>
<head>
    <title>Generate Invoice PDF</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;   
    }
    .w-85{
        width:85%;   
    }
    .w-15{
        width:15%;   
    }
    .logo img{
        width:45px;
        height:45px;
        padding-top:30px;
    }
    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Recibo</h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
        <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">{{$visita->id}}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{$visita->date}}</span></p>
    </div>
    <div class="w-50 float-left logo mt-10">
        
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <p class="m-0 pt-5 text-bold w-100">Información</p>
    <table class="table w-100 mt-10">
        <tr>
            <th class=""></th>
            <th class=""></th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p>DUI : {{$visita->patient->dui}}</p>
                    <p>Nombres : {{$visita->patient->name}}</p>
                    <p>Apellidos : {{$visita->patient->lastname}}</p>
                    <p>Telefono : {{$visita->patient->phone}}</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p>Telefono Secundario : {{$visita->patient->second_phone}}</p>
                    <p>Ocupación : {{$visita->patient->occupation}}</p>
                    <p>Sucursal : {{$visita->patient->branch_office->name}}</p>
                    <p>Dirección-Sucursal : {{$visita->patient->branch_office->address}}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Tratamiento</th>
            <th class="w-50">Cantidad</th>
            <th class="w-50">Precio</th>
            
        </tr>
        <tr align="center">
            <td>{{$visita->treatment->name}}</td>
            <td>1</td>
            <td>{{$visita->treatment->price}}</td>
        </tr>
        <tr>
            <td colspan="7">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Impuestos (5%)</p>
                        <p>Total a Pagar</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>{{$visita->treatment->price}}</p>
                        <p>{{number_format((($visita->treatment->price) * 0.05) , 2) }}</p>
                        <p>{{$visita->payment}}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div> 
            </td>
        </tr>
    </table>
</div>
</html>