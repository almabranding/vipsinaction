<?

/**
 * Api PHP Descom SMS v2.0
 * 
 * Api de gestion de SMS para la plataforma Descom SMS
 * 
 */
class dms_send
{

	/* Variables internas */
	var $proto='sms';	
	var $version='ApiPHPv1';

	/* Variables de Conexion */
	var $address='www.descomsms.com';
	var $port=443;
	
	var $debug=false;

	var $mailError="";
	var $MaxSMS=0;
	
	/* Variables Internas de funciones Soportadas */
	var $isssl=true;
	var $isxml=true;

	/* Subclases */
	var $autentificacion;
	var $mensajes;
	var $reportes_envios;
	var $contactosagragados;
	var $contactosdel;
	var $contactoasociar;
	var $contactos;
	var $grupos;
	var $gruposdel;

	/* Remitente generico para los mensajes si este no se especifica */
	var $remitente;
	var $idenvio;

	var $programacion;

	/* Constructor -> Inicializacion de SubClases */
	function dms_send(){
		$this->autentificacion=new dms_autentificate();
		$this->mensajes=new dms_mensajes();
		$this->programacion=new dms_programacion();
	}
	

	/* Funcion para asignar Soporte SSL */
	function SupportSSL($bool =false){
		if ($bool){
			$this->port=443;
			$this->isssl=true;
		}else{
			$this->port=80;
			$this->isssl=false;
		}
	}

	
	function hexToStr($hex){
	    	$string='';
		for ($i=0; $i < strlen($hex); $i+=2)
        		$string .= chr(hexdec(substr($hex,$i,2)));
	    	return $string;
	}	


	function array_push_associative(&$arr) {
		$args = func_get_args();
		foreach ($args as $arg) {
			if (is_array($arg)) {
				foreach ($arg as $key => $value) {
					$arr[$key] = $value;
					$ret++;
				}
			}else{
				$arr[$arg] = "";
			}
		}
		return $ret;
	}

	
	/* Funcion para enviar SMS a Plataforma Descom SMS */
	function send(){
		$this->url='/AP/descomMessage.servlet.Servlet';
		$this->proto='sms';

		$vusername=bin2hex($this->autentificacion->username);
		$vpassword=bin2hex($this->autentificacion->passwd);

		/* Create Parse XML */
		$parse = "<TXEnvio><Autentificacion>";
	        $parse .= "<Idcli>".$this->autentificacion->idcli."</Idcli><Usuario>".$vusername."</Usuario><Passwd>".$vpassword."</Passwd>"; /*tiene que ser valor ascii hexadecimal*/
		if ($this->remitente!=""){
			$vremitente=bin2hex($this->remitente);
		        $parse .= "<Remitente>".$vremitente."</Remitente>"; /*tiene que ser valor ascii hexadecimal*/
		}
		    $parse .= "<App>" . bin2hex($this->version) . "</App>";
	        $parse .= "</Autentificacion>";
		if ($this->idenvio!="")
			$TIdEnvio=" idenvioext='".bin2hex($this->idenvio)."'";
		$parse .= "<Mensajes".$TIdEnvio." total='".count($this->mensajes->get())."'>";
		if ($this->programacion->programado){
			//Programar Envio
			$MOREPROGRAMACION="";
			switch ($this->programacion->periodo){
				case "D":
					$MOREPROGRAMACION.=' progffin="'.$this->programacion->fechafin.'"';
					break;
				case "S":
					$MOREPROGRAMACION.=' progffin="'.$this->programacion->fechafin.'"';
					$MOREPROGRAMACION.=' progds="'.$this->programacion->diasSemana.'"';
                                        break;
				case "M":
					$MOREPROGRAMACION.=' progffin="'.$this->programacion->fechafin.'"';
					$MOREPROGRAMACION.=' progdm="'.$this->programacion->diasMes.'"';
                                        break;
				case "A":
                                        $MOREPROGRAMACION.=' progffin="'.$this->programacion->fechafin.'"';
					$MOREPROGRAMACION.=' progdm="'.$this->programacion->diasMes.'"';
					$MOREPROGRAMACION.=' progmes="'.$this->programacion->mes.'"';
                                        break;
			}
			$vPnombre=bin2hex($this->programacion->nombre);
			$parse.='<programacion progfini="'.$this->programacion->fechaini.'" proghora="'.$this->programacion->hora.'" idprog="'.$this->programacion->idprog.'" progperiodo="'.$this->programacion->periodo.'" progavisar="'.$this->programacion->avisar.'" prognombre="'.$vPnombre.'"'.$MOREPROGRAMACION.'>';
			$parse.="</programacion>";
		}
		if ($this->autentificacion->EmailNot!="" && $this->autentificacion->EmailNot!="0")
			$parse .= "<EmailNot>".$this->autentificacion->EmailNot."</EmailNot>"; 
		$parse .= "<MaxSMS>".$this->MaxSMS."</MaxSMS>"; 	
		$parse .= "<Total>" . count($this->mensajes->get()) . "</Total>";
		$parse .= "<Control>1</Control>";
		foreach ($this->mensajes->get() as $msg){
			$parse .= "<Mensaje>";
			$parse .= "<ID>" . $msg->key . "</ID>";
			$parse .= "<Destino>" . $msg->destino . "</Destino>";
			$parse .= "<Texto>" . bin2hex($msg->mensaje) . "</Texto>";	/*tiene que ser valor ascii hexadecimal*/
			if ($msg->remitente!=""){
				$parse .= "<Remitente>" . bin2hex($msg->remitente) . "</Remitente>";
			}
			$parse .= "</Mensaje>";
		}
		$parse .= "</Mensajes></TXEnvio>";
		if ($this->debug) echo "XML Envio: \n".$parse."\n\n";
		$post_data .= "&usuario=".$this->autentificacion->username."&clave=".$this->autentificacion->passwd."&xml=".$parse;
		/* Send Data to API */
		if ($this->isssl){
			$this->sendHTTPS($post_data);
		}else{
			$this->sendHTTP($post_data);
		}
		
	}

	
	function getReports($filtro){
                $this->url='/AP/dmapi.servlet.Servlet';
		$this->proto='report';
		$this->reportes_envios=new dms_reports;
		$vusername=bin2hex($this->autentificacion->username);
		$vpassword=bin2hex($this->autentificacion->passwd);
		$xml='<TXEnvio><Autentificacion><Usuario>'.$vusername.'</Usuario><Passwd>'.$vpassword.'</Passwd><Idcli>'.$this->autentificacion->idcli.'</Idcli><App>'.bin2hex($this->version).'</App></Autentificacion>';
		$xml.='<Reportget accion="GETR">';
		if ($filtro->idreport!="") $xml.='<idreport>'.$filtro->idreport.'</idreport>';
		if ($filtro->periodo!="") $xml.='<periodo>'.$filtro->periodo.'</periodo>';
		if ($filtro->fini!="") $xml.='<fini>'.$filtro->fini.'</fini>';
		if ($filtro->ffin!="") $xml.='<ffin>'.$filtro->ffin.'</ffin>';
        	$xml.='<nfilas>'.$filtro->nfilas.'</nfilas>';
		if ($filtro->ndesde!="" && $filtro->ndesde!="1") $xml.='<ndesde>'.$filtro->ndesde.'</ndesde>';
        	if (strtolower($filtro->ndesde=="desc")) $xml.='<orden>desc</orden>';
		$xml.='</Reportget></TXEnvio>';
		if ($this->debug) echo "XML Envio: \n".$xml."\n\n";
		$post_data .= "&xml=" . $xml;
		if ($this->isssl){
                        $this->sendHTTPS($post_data);
                }else{
                        $this->sendHTTP($post_data);
                }	

	}

        function getReportsMensajes($filtro){
                $this->url='/AP/dmapi.servlet.Servlet';
                $this->proto='reportmsg';
                $this->reportes_envios=new dms_reports;
                $vusername=bin2hex($this->autentificacion->username);
                $vpassword=bin2hex($this->autentificacion->passwd);
                $xml='<TXEnvio><Autentificacion><Usuario>'.$vusername.'</Usuario><Passwd>'.$vpassword.'</Passwd><Idcli>'.$this->autentificacion->idcli.'</Idcli><App>'.bin2hex($this->version).'</App></Autentificacion>';
                $xml.='<Reportget accion="GETM">';
                if ($filtro->idreport!="") $xml.='<idreport>'.$filtro->idreport.'</idreport>';
                if ($filtro->periodo!="") $xml.='<periodo>'.$filtro->periodo.'</periodo>';
                if ($filtro->fini!="") $xml.='<fini>'.$filtro->fini.'</fini>';
                if ($filtro->ffin!="") $xml.='<ffin>'.$filtro->ffin.'</ffin>';
                $xml.='<nfilas>'.$filtro->nfilas.'</nfilas>';
                if ($filtro->ndesde!="" && $filtro->ndesde!="1") $xml.='<ndesde>'.$filtro->ndesde.'</ndesde>';
                if (strtolower($filtro->ndesde=="desc")) $xml.='<orden>desc</orden>';
		if ($filtro->bidsend!='') $xml.='<busqueda><bidsend>'.$filtro->bidsend.'</bidsend></busqueda>';
                $xml.='</Reportget></TXEnvio>';
		if ($this->debug) echo "XML Envio: \n".$xml."\n\n";
                $post_data .= "&xml=" . $xml;
                if ($this->isssl){
                        $this->sendHTTPS($post_data);
                }else{
                        $this->sendHTTP($post_data);
                }

        }


	function selectAdvContacts($filtro,$cmd,$lista_asociar="",$lista_nueva=""){
                $this->url='/AP/dmapi.servlet.Servlet';
                $this->proto='contactget'.$cmd;
		$this->contactos=new dms_contats;
                $vusername=bin2hex($this->autentificacion->username);
                $vpassword=bin2hex($this->autentificacion->passwd);
                $xml='<TXEnvio><Autentificacion><Usuario>'.$vusername.'</Usuario><Passwd>'.$vpassword.'</Passwd><Idcli>'.$this->autentificacion->idcli.'</Idcli><App>'.bin2hex($this->version).'</App></Autentificacion>';
                $xml.='<CONTACTOSGET accion="'.$cmd.'">';
		$xml.='<cbusqueda>';
		$xml.='<cfilas>'.$filtro->nfilas.'</cfilas>';
                if ($filtro->ndesde!="" && $filtro->ndesde!="1") $xml.='<cdesde>'.$filtro->ndesde.'</cdesde>';
		if ($filtro->ordencampo!=""){
			$xml.='<orden1_campo>'.$filtro->ordencampo.'</orden1_campo>';
			$xml.='<orden1_tipo>'.$orden.'</orden1_tipo>';
		}
		if (count($filtro->argbusqueda)>0){
			$xml.='<cbparamlist union="'.$filtro->union.'">';
				foreach ($filtro->argbusqueda as $b){
					$xml.='<cbparametro><pbcampo>'.$b[0].'</pbcampo><pbvalor>'.bin2hex($b[1]).'</pbvalor><pboperador>'.$b[2].'</pboperador></cbparametro>';
				}
			$xml.='</cbparamlist>';
		}
		if ($cmd=="LASOC"){
			if ($lista_asociar!="")
				$xml.='<lista_asociar>'.$lista_asociar.'</lista_asociar>';
			if ($lista_nueva!="")
				$xml.='<lista_nueva>'.$lista_nueva.'</lista_nueva>';
		}
		$xml.='</cbusqueda>';
                $xml.='</CONTACTOSGET></TXEnvio>';
                if ($this->debug) echo "XML Envio: \n".$xml."\n\n";
                $post_data = "&xml=" . $xml;
                if ($this->isssl){
                        $this->sendHTTPS($post_data);
                }else{
                        $this->sendHTTP($post_data);
                }

	}

	function getContacts($filtro){
		$this->selectAdvContacts($filtro,"CGET");
        }

	function delContacts($filtro){
		$this->contactosdel= new dms_contactdel;
		$this->selectAdvContacts($filtro,"CDEL");
	}

	function asociarContacts($filtro,$lista_asociar="",$lista_nueva=""){
		$this->contactosasociar= new dms_contactasociados;
		$this->selectAdvContacts($filtro,"LASOC",$lista_asociar,$lista_nueva);
	}

	function addContacts($contactos,$accion_existe="A",$lista_asociar="",$lista_nueva=""){
		if (count($contactos)==0){
			return;
		}
                $this->url='/AP/dmapi.servlet.Servlet';
                $this->proto='contactadd';
		$this->contactosagragados= new dms_contactadd;
		$vusername=bin2hex($this->autentificacion->username);
                $vpassword=bin2hex($this->autentificacion->passwd);
		if ($lista_asociar!=""){
			$lista_asociar=' lista_asociar="'.$lista_asociar.'"';
		}
		if ($lista_nueva!=""){
                        $lista_nueva=' lista_nueva="'.$lista_nueva.'"';
                }
                $xml='<TXEnvio><Autentificacion><Usuario>'.$vusername.'</Usuario><Passwd>'.$vpassword.'</Passwd><Idcli>'.$this->autentificacion->idcli.'</Idcli><App>'.bin2hex($this->version).'</App></Autentificacion>';
                $xml.='<CONTACTOSSET accion="CADD" accion_existe="'.$accion_existe.'"'.$lista_asociar.$lista_nueva.'>';

		foreach ($contactos as $contacto){
			$xml.='<cdcontacto>';
			foreach ($contacto as $cdcampo => $cdvalor ){
				$cdvalor=bin2hex($cdvalor);
				$xml.='<cdparametro><cdcampo>'.$cdcampo.'</cdcampo><cdvalor>'.$cdvalor.'</cdvalor></cdparametro>';
			}
			$xml.='</cdcontacto>';
		}

		$xml.='</CONTACTOSSET></TXEnvio>';
                if ($this->debug) echo "XML Envio: \n".$xml."\n\n";
                $post_data .= "&xml=" . $xml;
                if ($this->isssl){
                        $this->sendHTTPS($post_data);
                }else{
                        $this->sendHTTP($post_data);
                }
	}

        function getGroups(){
                $this->url='/AP/dmapi.servlet.Servlet';
                $this->proto='groupget';
		$this->grupos=new dms_groups;
                $vusername=bin2hex($this->autentificacion->username);
                $vpassword=bin2hex($this->autentificacion->passwd);
                $xml='<TXEnvio><Autentificacion><Usuario>'.$vusername.'</Usuario><Passwd>'.$vpassword.'</Passwd><Idcli>'.$this->autentificacion->idcli.'</Idcli><App>'.bin2hex($this->version).'</App></Autentificacion>';
                $xml.='<LISTASGET accion="LGET"></LISTASGET></TXEnvio>';

                if ($this->debug) echo "XML Envio: \n".$xml."\n\n";
                $post_data = "&xml=" . $xml;
                if ($this->isssl){
                        $this->sendHTTPS($post_data);
                }else{
                        $this->sendHTTP($post_data);
                }
        }

	function delGroups($lista_id,$borrarContacto=false){
                $this->url='/AP/dmapi.servlet.Servlet';
                $this->proto='groupdel';
                $this->gruposdel=new dms_groupdel;
                $vusername=bin2hex($this->autentificacion->username);
                $vpassword=bin2hex($this->autentificacion->passwd);
		if ($borrarContacto)
			$DCON='<borrar_contactos>si</borrar_contactos>';
		else
			$DCON='<borrar_contactos>no</borrar_contactos>';
		if ($lista_id!="")
			$DLISTA='<lista_id>'.$lista_id.'</lista_id>';
		else
			$DLISTA='';

                $xml='<TXEnvio><Autentificacion><Usuario>'.$vusername.'</Usuario><Passwd>'.$vpassword.'</Passwd><Idcli>'.$this->autentificacion->idcli.'</Idcli><App>'.bin2hex($this->version).'</App></Autentificacion>';
                $xml.='<LISTASGET accion="LDEL">'.$DLISTA.$DCON.'</LISTASGET></TXEnvio>';

                if ($this->debug) echo "XML Envio: \n".$xml."\n\n";
                $post_data = "&xml=" . $xml;
                if ($this->isssl){
                        $this->sendHTTPS($post_data);
                }else{
                        $this->sendHTTP($post_data);
                }
	}

	/* Funcion para enviar datos a Api */
	function sendHTTP($post_data){
		$fp = fsockopen ( $this->address, $this->port); 
		$ret = ''; 
		if ($fp) {
			fputs($fp, "POST ".$this->url." HTTP/1.1\n"); 
			fputs($fp, "Host: ".$this->address."\n"); 
			fputs($fp, "Content-Length: " . strlen( $post_data ). "\n"); 
			fputs($fp, "Content-Type: application/x-www-form-urlencoded\n"); 
			fputs($fp, "Connection: close\n\n");
			fputs($fp, $post_data);

			while (!feof($fp)) $ret .= fgets ( $fp, 128 ); 
				fclose ($fp); 
			$retu = spliti("Content-Type: text/xml",$ret);
			if ($this->proto=='sms')
				$this->parseResultXML ($retu);
			if ($this->proto=='report')
                                $this->parseResultXMLReport ($retu);
                        if ($this->proto=='reportmsg')
                        	$this->parseResultXMLReportMsg ($retu);
			if ($this->proto=='contactadd')
                                $this->parseResultContactAdd ($retu);
			if ($this->proto=='contactgetCGET')
                                $this->parseResultContactGet ($retu);
			if ($this->proto=='contactgetCDEL')
                                $this->parseResultContactDel ($retu);
			if ($this->proto=='contactgetLASOC')
                                $this->parseResultContactAsociar ($retu);
			if ($this->proto=='groupget')
				$this->parseResultGroupGet($retu);
			if ($this->proto=='groupdel')
                                $this->parseResultGroupDel($retu);
		} else {
			//Error  en la conexi�n con la plataforma
			$this->autentificacion->error=true;
			$this->autentificacion->mensajeerror="Conexion imposible";
		}
	}

	/* Funcion para enviar datos a API de forma segura */
	function sendHTTPS($post_data){
		$fp = fsockopen ( "ssl://" . $this->address, $this->port);
		if ($fp) {
			fputs($fp, "POST ".$this->url." HTTP/1.1\r\n");
			fputs($fp, "Host: ".$this->address."\r\n");
			fputs($fp, "Content-Length: " . strlen( $post_data ). "\r\n");
			fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
			fputs($fp, "Connection: close\r\n\r\n");
			fputs($fp, $post_data);
			$ret='';
			while (!feof($fp)) $ret .= fgets ( $fp, 128 );
				fclose ($fp);
                        $retu =  explode("Content-Type: text/xml",$ret);
			if ($this->proto=='sms')
				$this->parseResultXML ($retu);
			if ($this->proto=='report')
                                $this->parseResultXMLReport ($retu);
			if ($this->proto=='reportmsg')
                                $this->parseResultXMLReportMsg ($retu);
			if ($this->proto=='contactadd')
                                $this->parseResultContactAdd ($retu);
			if ($this->proto=='contactgetCGET')
                                $this->parseResultContactGet ($retu);
			if ($this->proto=='contactgetCDEL')
                                $this->parseResultContactDel ($retu);
			if ($this->proto=='contactgetLASOC')
                                $this->parseResultContactAsociar ($retu);
			if ($this->proto=='groupget')
                                $this->parseResultGroupGet($retu);
			if ($this->proto=='groupdel')
                                $this->parseResultGroupDel($retu);
		} else {
			//Error  en la conexi�n con la plataforma
			$this->autentificacion->error=true;
			$this->autentificacion->mensajeerror="Conexion imposible";
		}
	}


        function parseResultContactGet($retu){
                if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado ".$retu[0];
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
                }else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
                        try{
                                $xml = new SimpleXMLElement($rxml[1]);
                        } catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
                        if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
                                        $this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
                        if (! $this->autentificacion->error){
				$this->contactos->ntotal=$xml->CONTACTOSLIST->attributes()->ntotal;
                                $this->contactos->nfilas=$xml->CONTACTOSLIST->attributes()->nfilas;
                                $this->contactos->ndesde=$xml->CONTACTOSLIST->attributes()->ndesde;
				foreach ($xml->CONTACTOSLIST->LCONTACTO as $ct){
					$Contacto=new dms_contact;
					$Contacto->n=$this->hexToStr($ct->LCN);
					$Contacto->id=$this->hexToStr($ct->LCID);
					$Contacto->numero=$this->hexToStr($ct->LCNUMERO);
                                        $Contacto->nombre=$this->hexToStr($ct->LCNOMBRE);
                                        $Contacto->apellidos=$this->hexToStr($ct->LCAPELLIDOS);
                                        $Contacto->tratamiento=$this->hexToStr($ct->LCTRATAMIENTO);
                                        $Contacto->alias=$this->hexToStr($ct->LCALIAS);
                                        $Contacto->sexo=$this->hexToStr($ct->LCSEXO);
                                        $Contacto->localizacion=$this->hexToStr($ct->LCLOCALICACION);
                                        $Contacto->etiqueta=$this->hexToStr($ct->LCETIQUETA);
                                        $Contacto->nota=$this->hexToStr($ct->LCNOTA);
                                        $Contacto->cp=$this->hexToStr($ct->LCCP);
                                        $Contacto->fnac=$this->hexToStr($ct->LCFNAC);
                                        $Contacto->empresa=$this->hexToStr($ct->LCEMPRESA);
                                        $Contacto->operador=$this->hexToStr($ct->LCOPERADOR);
                                        $Contacto->tienecasa=$this->hexToStr($ct->LCTIENECASA);
                                        $Contacto->tienehijos=$this->hexToStr($ct->LCTIENEHIJOS);
                                        $Contacto->tienecoche=$this->hexToStr($ct->LCTIENECOCHE);
                                        $Contacto->marca=$this->hexToStr($ct->LCMARCA);
                                        $Contacto->modelo=$this->hexToStr($ct->LCMODELO);
					array_push($this->contactos->contactos,$Contacto);
				}
                        }

                }
        }



        function parseResultContactDel($retu){
                if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado ".$retu[0];
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
                }else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
                        try{
                                $xml = new SimpleXMLElement($rxml[1]);
                        } catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
                        if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
                                        $this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
                        if (! $this->autentificacion->error){
                                foreach ($xml->CONTACTOSDEL as $ct){
					$this->contactosdel->total_contactos_borrados=$ct->total_contactos_borrados;
                                }
                        }

                }
        }

        function parseResultContactAsociar($retu){
                if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado ".$retu[0];
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
                }else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
                        try{
                                $xml = new SimpleXMLElement($rxml[1]);
                        } catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
                        if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
                                        $this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
                        if (! $this->autentificacion->error){
                                foreach ($xml->CONTACTOSLASOC as $ct){
                                        $this->contactosasociar->total_contactos_asociados=$ct->total_contactos_asociados;
                                }
                        }

                }
        }


	function parseResultContactAdd($retu){
		if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado ".$retu[0];
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
                }else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
                        try{
                                $xml = new SimpleXMLElement($rxml[1]);
                        } catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
                        if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
                                        $this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
                        if (! $this->autentificacion->error){
				foreach ($xml->CONTACTOSADD as $cadd) {
					$this->contactosagragados->total_contactos=$cadd->total_contactos;
					$this->contactosagragados->total_contactos_nuevos=$cadd->total_contactos_nuevos;
					$this->contactosagragados->total_contactos_actualizados=$cadd->total_contactos_actualizados;
					$this->contactosagragados->total_contactos_ignorados=$cadd->total_contactos_ignorados;
					$this->contactosagragados->total_contactos_errores=$cadd->total_contactos_errores;
				}
                        }

		}
	}


        function parseResultGroupGet($retu){
                if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado ".$retu[0];
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
                }else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
                        try{
                                $xml = new SimpleXMLElement($rxml[1]);
                        } catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
                        if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
                                        $this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
                        if (! $this->autentificacion->error){
                                $this->grupos->ntotal=$xml->LISTASLIST->attributes()->ntotal;
                                foreach ($xml->LISTASLIST->LISTA as $ct){
                                        $grupo=new dms_group;
                                        $grupo->ln=$this->hexToStr($ct->LN);
					$grupo->lid=$this->hexToStr($ct->LID);
					$grupo->lname=$this->hexToStr($ct->LNAME);
					$grupo->lpclave=$this->hexToStr($ct->LPCLAVE);
					$grupo->lnc=$this->hexToStr($ct->LNC);
                                        array_push($this->grupos->grupos,$grupo);
                                }
                        }

                }
        }


        function parseResultGroupDel($retu){
                if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado ".$retu[0];
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
                }else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
                        try{
                                $xml = new SimpleXMLElement($rxml[1]);
                        } catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
                        if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
                                        $this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
                        if (! $this->autentificacion->error){
                                foreach ($xml->LISTASDEL as $ct){
                                        $this->gruposdel->total_grupos_borrados=$ct->total_listas_borradas;
                                }
				foreach ($xml->CONTACTOSDEL as $ct){
                                        $this->gruposdel->total_contactos_borrados=$ct->total_contactos_borrados;
                                }
                        }

                }
        }


	function parseResultXMLReport($retu){
		if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado";
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
		}else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
			try{
	                        $xml = new SimpleXMLElement($rxml[1]);
			} catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
			if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
					$this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
			if (! $this->autentificacion->error){
				$this->reportes_envios->ntotal=$xml->REPORTLIST->attributes()->ntotal;
				$this->reportes_envios->nfilas=$xml->REPORTLIST->attributes()->nfilas;
				$this->reportes_envios->ndesde=$xml->REPORTLIST->attributes()->ndesde;
				foreach ($xml->REPORTLIST->REPORT as $rt) {
					$itemR=new dms_report;
					$itemR->nr=$rt->nr;
				        $itemR->fecha_envio=$rt->fecha_envio;
				        $itemR->idreport=$rt->idreport;
				        $itemR->estado=$rt->estado;
				        $itemR->idenvio=$rt->idenvio;
				        $itemR->total_mensajes=$rt->total_mensajes;
				        $itemR->total_contactos=$rt->total_contactos;
				        $itemR->total_creditos=$rt->total_creditos;
				        $itemR->app=$rt->app;
				        $itemR->htexto=$this->hexToStr($rt->htexto);
				        $itemR->hremitente=$this->hexToStr($rt->hremitente);
				        $itemR->informe=$rt->informe;
				        $itemR->sin_confirmacion=$rt->sin_confirmacion;
				        $itemR->confirmados=$rt->confirmados;
				        $itemR->errores=$rt->errores;
				        $itemR->sin_informacion=$rt->sin_informacion;
					array_push($this->reportes_envios->reportes,$itemR);
				}
			}
		}

	}

        function parseResultXMLReportMsg($retu){
                if ( (!is_array($retu)) | (count($retu)<2) ){
                        //Error de acceso a la plataforma
                        $this->autentificacion->error=true;
                        $this->autentificacion->mensajeerror="Contenido inesperado";
                        if ($this->mailError!=""){
                                $para      = $this->mailError;
                                $asunto    = 'Erro en el env�o de SMS';
                                $mensaje   = 'Contenido inesperado:\r\n'.$retu;
                                $cabeceras = 'From: '.$this->mailError. "\r\n" .
                            'X-Mailer: Descom/';
                                mail($para, $asunto, $mensaje, $cabeceras);
                        }
                }else{
                        $r=str_replace("�","",$retu[1]);
                        $rxml=split("\?>",$r);
			if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
			try{
	                        $xml = new SimpleXMLElement($rxml[1]);
			} catch (Exception $e) {
                                $xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
                        }
                        foreach ($xml->Autentificacion as $auth) {
                                if ($auth->Resultado=="1"){
                                        $this->autentificacion->error=false;
                                        $this->autentificacion->mensajeerror="";
                                }else{
                                        $this->autentificacion->error=true;
                                        $this->autentificacion->mensajeerror=$auth->Comentario;
                                        return;
                                }
                        }
                        if (! $this->autentificacion->error){
                                $this->reportes_envios->ntotal=$xml->MENSAJELIST->attributes()->ntotal;
                                $this->reportes_envios->nfilas=$xml->MENSAJELIST->attributes()->nfilas;
                                $this->reportes_envios->ndesde=$xml->MENSAJELIST->attributes()->ndesde;
                                foreach ($xml->MENSAJELIST->MENSAJE as $rt) {
                                        $itemR=new dms_report;
					$itemR->nm=$rt->nm;
			                $itemR->fecha_enviado=$rt->fecha_enviado;
			                $itemR->idsend=$rt->idsend;
			                $itemR->idreport=$rt->idreport;
			                $itemR->movil=$rt->movil;
			                $itemR->htexto=$this->hexToStr($rt->htexto);
			                $itemR->nmens=$rt->nmens;
			                $itemR->hremitente=$this->hexToStr($rt->hremitente);
			                $itemR->hcname=$this->hexToStr($rt->hcname);
			                $itemR->hcapellidos=$this->hexToStr($rt->hcapellidos);
			                $itemR->estado=$rt->estado;
			                $itemR->estadocod=$rt->estadocod;
			                $itemR->estadohdesc=$this->hexToStr($rt->estadohdesc);
			                $itemR->fecha_entregado=$rt->fecha_entregado;
			                $itemR->fecha_confirmado=$rt->fecha_confirmado;
                                        array_push($this->reportes_envios->reportes,$itemR);
                                }
                        }
                }

        }

	/* Parseado respuesta en formato XML */
	function parseResultXML($retu){
		if ( (!is_array($retu)) | (count($retu)<2) ){
			//Error de acceso a la plataforma
			$this->autentificacion->error=true;
			$this->autentificacion->mensajeerror="Contenido inesperado";
			if ($this->mailError!=""){
				$para      = $this->mailError;
				$asunto    = 'Error en el env�o de SMS';
				$mensaje   = 'Contenido inesperado:\r\n'.$retu;
				$cabeceras = 'From: '.$this->mailError. "\r\n" .
			    'X-Mailer: Descom/';
				mail($para, $asunto, $mensaje, $cabeceras);
			}
		}else{
			$r=str_replace("�","",$retu[1]);
			$rxml= explode("\?>",$r);
			if ($this->debug) echo "XML Respuesta: \n".$rxml[1]."\n\n";
			try{
				$xml = new SimpleXMLElement($rxml[1]);
			} catch (Exception $e) {
				$xml=new SimpleXMLElement('<XML><Autentificacion><Resultado>0</Resultado><Comentario>trama XML no valida</Comentario></Autentificacion></XML>');
			}
			foreach ($xml->Autentificacion as $auth) {
				if ($auth->Resultado=="1"){
					$this->autentificacion->error=false;
					$this->autentificacion->mensajeerror="";
					$this->autentificacion->saldo=$auth->Saldo;
				}else{
					$this->autentificacion->error=true;
					$this->autentificacion->mensajeerror=$auth->Comentario;
					$this->autentificacion->saldo=0;
					echo $xml;
					return;
					
				}
			}
			$counter=0;
			if ($this->programacion->programado){
				$this->programacion->result_id=$xml->Mensajes->programacion->attributes()->idprog;
				$this->programacion->result_msg_ok=$xml->Mensajes->programacion->attributes()->progok;
				$this->programacion->result_msg_err=$xml->Mensajes->programacion->attributes()->progerr;
				$this->programacion->result_resultado=$xml->Mensajes->programacion->attributes()->progresultado;
			}
			$this->mensajes->idenviodm=$xml->Mensajes->attributes()->idenviodm;
			$this->mensajes->total_mensajes=$xml->Mensajes->attributes()->total_mensajes;
		    $this->mensajes->total_ok=$xml->Mensajes->attributes()->total_ok;
		    $this->mensajes->total_error=$xml->Mensajes->attributes()->total_error;
			$this->mensajes->total_sms_ok=$xml->Mensajes->attributes()->total_sms_ok;
		    $this->mensajes->total_sms_error=$xml->Mensajes->attributes()->total_sms_error;
		    $this->mensajes->total_creditos=$xml->Mensajes->attributes()->total_creditos;
			foreach ($xml->Mensajes->Mensaje as $msg) {
				if ($this->mensajes->get($counter)==$msg->Id) {
					if ($msg->Resultado!="1"){				
							$this->mensajes($counter)->idDM=0;
							$this->mensajes($counter)->error=true;
							$this->mensajes($counter)->mensajeerror=$msg->Comentario;
					}else{
							$this->mensajes($counter)->idDM=$msg->IdDM;
							$this->mensajes($counter)->error=false;
							$this->mensajes($counter)->mensajeerror=$msg->Comentario;
					}
				}else{
					foreach ($this->mensajes->get() as $msg1){
						if ($msg1->key==$msg->Id){
							if ($msg->Resultado!="1"){	
								$msg1->error=true;
								$msg1->idDM="0";
								$msg1->mensajeerror=$msg->Comentario;
							}else{
								$msg1->error=false;
								$msg1->idDM=$msg->IdDM;
								$msg1->mensajeerror=$msg->Comentario;
							}
						}
					}
				}
				$counter+=1;
			}
		}
		$this->programacion->nunca();
	}
}

/**
 * Clase para autentificar con la plataforma
*/
class dms_autentificate
{
	/**
	 * Especificar nombre de usuario en la plataforma Descom SMS
	*/
	var $username;
	/**
         * Especificar clave de acceso a la plataforma Descom SMS
        */
	var $passwd;
	/**
         * Establecer el mail para recibir notificaciones de entrega, previamente configurado en la plataforma
        */
        var $EmailNot='';
	/**
         * Especificar codigo de cliente en la plataforma Descom SMS
        */
	var $idcli=0;
	/**
         * Obtener creditos disponibles de la cienta Descom SMS
        */
	var $saldo=0;
	/**
         * @global boolean; retorna si hay error de acceso a la plataforma
        */
	var $error=false;
	/**
         * Obtener la descripcion del error de acceso a la plataforma
        */
	var $mensajeerror;
}

/**
 * Clase de propiedades de mensaje SMS
*/
class dms_mensaje
{
	var $key;
	var $destino;
	var $mensaje;
	var $remitente;
	var $idDM;
	var $error=true;
	var $mensajeerror;
}

/**
 * Clase para definir busquedas de reportes
*/
class dms_busqueda
{
	var $bidsend;
	var $bnombre;
	var $bmovil;
	var $blista;
	var $btexto;
	var $bestado;
}


/**
 * Clase para definir filtros de reportes
*/

class dms_filtro{
	var $idreport='';
	var $periodo='D';
	var $fini='';
	var $ffin='';
	var $nfilas='10';
	var $ndesde='1';
	var $orden='Asc';
	var $ordencampo='';
	var $busqueda;
	var $argbusqueda=Array();
	var $union='';
	var $bidsend='';
	function agregarBusqueda($campo,$valor,$operador){
		$t=Array($campo,$valor,$operador);
		array_push($this->argbusqueda,$t);
	}
}


/**
 * Clase resultado de agregar contactos
*/

class dms_contactadd{
	var $total_contactos=0;
	var $total_contactos_nuevos=0;
	var $total_contactos_actualizados=0;
	var $total_contactos_ignorados=0;
	var $total_contactos_errores=0;
}

class dms_contactdel{
	var $total_contactos_borrados=0;
}

class dms_contactasociados{
        var $total_contactos_asociados=0;
}

class dms_contats
{
        var $contactos=array();
        var $ntotal=0;
        var $nfilas=0;
        var $ndesde=0;
}

class dms_contact
{
	var $n;
	var $id;
	var $numero;
	var $nombre;
	var $apellidos;
	var $tratamiento;
	var $alias;
	var $sexo;
	var $localizacion;
	var $etiqueta;
	var $nota;
	var $cp;
	var $fnac;
	var $empresa;
	var $operador;
	var $tienecasa;
	var $tienehijos;
	var $tienecoche;
	var $marca;
	var $modelo;
}

class dms_groups{
	var $grupos=array();
	var $ntotal=0;
}


class dms_group{
	var $ln="";
	var $lid="";
	var $lname="";
	var $lpclave="";
	var $lnc="";
}

class dms_groupdel{
	var $total_grupos_borrados=0;
        var $total_contactos_borrados=0;
}


/**
 * Clase colleccion de reportes obtenidos
*/
class dms_reports
{
	var $reportes=array();
	var $ntotal=0;
	var $nfilas=0;
	var $ndesde=0;
}

/**
 * Propiedades de cada reporte de envio
*/
class dms_report
{
	var $nr='';
	var $fecha_envio='';
	var $idreport='';
	var $estado='';
	var $idenvio='';
	var $total_mensajes='';
	var $total_contactos='';
	var $total_creditos='';
	var $app='';
	var $htexto='';
	var $hremitente='';
	var $informe='';
	var $sin_confirmacion='';
	var $confirmados='';
	var $errores='';
	var $sin_informacion='';
}

/**
 * Propiedades de cada reporte de mensajes
*/
class dms_report_mensajes
{
	var $nm;
        var $fecha_enviado;
        var $idsend;
        var $idreport;
        var $movil;
        var $htexto;
        var $nmens;
        var $hremitente;
        var $hcname;
        var $hcapellidos;
        var $estado;
        var $estadocod;
        var $estadohdesc;
        var $fecha_entregado;
        var $fecha_confirmado;
}

/**
 * Propiedes para programar envios de mensajes SMS
*/
class dms_programacion
{
	var $programado=false;
	var $idprog;
	var $fechaini;
	var $hora;
	var $fechafin;
	var $periodo;
	var $nombre;
	var $avisar;
	var $diasSemana;
	var $diasMes;
	var $mes;

	var $result_id=0;
	var $result_msg_ok=0;
	var $result_msg_err=0;
	var $result_resultado=0;
	function nunca(){
		$this->programado=false;
		$idprog='';
		$fechaini;
	        $hora='';
	        $fechafin='';
	        $periodo='';
        	$nombre='';
	        $avisar='';
        	$diasSemana='';
	        $diasMes='';
        	$mes='';
	}
	function unavez($idprog,$nombre,$fecha,$hora){
		$this->programado=true;
		$this->periodo="1";
		$this->idprog=$idprog;
		$this->nombre=$nombre;
		$this->fechaini=$fecha;
		$this->hora=$hora;
	}
        function diariamente($idprog,$nombre,$fecha,$hora,$fechafin){
		$this->programado=true;
                $this->periodo="D";
                $this->idprog=$idprog;
                $this->nombre=$nombre;
                $this->fechaini=$fecha;
                $this->hora=$hora;	
		$this->fechafin=$fechafin;
        }
	function semanalmente($idprog,$nombre,$fecha,$hora,$fechafin,$diaSemana){
		$this->programado=true;
                $this->periodo="S";
                $this->idprog=$idprog;
                $this->nombre=$nombre;
                $this->fechaini=$fecha;
                $this->hora=$hora;
                $this->fechafin=$fechafin;
		$this->diasSemana=$diaSemana;
	}
	function mensualmente($idprog,$nombre,$fecha,$hora,$fechafin,$diaMes){
		$this->programado=true;
                $this->periodo="M";
                $this->idprog=$idprog;
                $this->nombre=$nombre;
                $this->fechaini=$fecha;
                $this->hora=$hora;
                $this->fechafin=$fechafin;
                $this->diasMes=$diaMes;
	}
	function anualmente($idprog,$nombre,$fecha,$hora,$fechafin,$diaMes,$mes){
                $this->programado=true;
                $this->periodo="A";
                $this->idprog=$idprog;
                $this->nombre=$nombre;
                $this->fechaini=$fecha;
                $this->hora=$hora;
                $this->fechafin=$fechafin;
                $this->diasMes=$diaMes;
		$this->mes=$mes;
	}
}

/* Clase de coleccion de Mensajes */
class dms_mensajes
{
	var $idenviodm;	
	var $total_mensajes;
	var $total_ok;
	var $total_error;
	var $total_sms_ok;
	var $total_sms_error;
	var $total_creditos;
	var $mensajes=array();

        function add($key,$destino,$mensaje,$remitente=""){
		/**if (MaxSizeMessage>0){
			if (strlen($mensaje)>MaxSizeMessage)
				$mensaje=substr($mensaje,0,MaxSizeMessage);
		}**/
		$msg = new dms_mensaje();
        $msg->key=$key;
        $msg->destino=$destino;
        $msg->mensaje=$mensaje;
        $msg->remitente=$remitente;
        array_push($this->mensajes,$msg);        
        }

	function get(){
		return $this->mensajes;
	}

	
}



?>
