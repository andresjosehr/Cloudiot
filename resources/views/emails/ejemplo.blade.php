<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAPENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">
   <SOAP-ENV:Header>
      <m:sendDataExtraccionTraza xmlns:m="http://www.mop.cl/controlextraccion/xsd/datosExtraccion/SendDataExtraccionRequest">
         <m:codigoDeLaObra>OB-0303-204</m:codigoDeLaObra>
         <m:timeStampOrigen>2001-12-17T09:30:47Z</m:timeStampOrigen>
      </m:sendDataExtraccionTraza>
   </SOAP-ENV:Header>
   <SOAP-ENV:Body>
      <m:sendDataExtraccionRequest xmlns:m="http://www.mop.cl/controlextraccion/xsd/datosExtraccion/SendDataExtraccionRequest">
         <m:dataExtraccionSubterranea>
            <m:fechaMedicion>17-08-1967</m:fechaMedicion>
            <m:horaMedicion>00:01:01</m:horaMedicion>
            <m:totalizador>1234567891</m:totalizador>
            <m:caudal>12345678.12</m:caudal>
            <m:nivelFreaticoDelPozo >12345678.12</m:nivelFreaticoDelPozo >
         </m:dataExtraccionSubterranea>
      </m:sendDataExtraccionRequest>
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>