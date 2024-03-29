<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAPENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
   <SOAP-ENV:Header>
      <m:sendDataExtraccionTraza xmlns:m="http://www.mop.cl/controlextraccion/xsd/datosExtraccion/SendDataExtraccionRequest">
         <m:codigoDeLaObra>{{$data["codigoDeLaObra"]}}</m:codigoDeLaObra>
         <m:timeStampOrigen>{{$data["timeStampOrigen"]}}</m:timeStampOrigen>
      </m:sendDataExtraccionTraza>
   </SOAP-ENV:Header>
   <SOAP-ENV:Body>
      <m:sendDataExtraccionRequest xmlns:m="http://www.mop.cl/controlextraccion/xsd/datosExtraccion/SendDataExtraccionRequest">
         <m:dataExtraccionSubterranea>
            <m:fechaMedicion>{{$data["fechaMedicion"]}}</m:fechaMedicion>
            <m:horaMedicion>{{$data["horaMedicion"]}}</m:horaMedicion>
            <m:totalizador>{{$data["totalizador"]}}</m:totalizador>
            <m:caudal>{{$data["caudal"]}}</m:caudal>
            <m:nivelFreaticoDelPozo >{{$data["nivelFreaticoDelPozo"]}}</m:nivelFreaticoDelPozo >
         </m:dataExtraccionSubterranea>
      </m:sendDataExtraccionRequest>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>