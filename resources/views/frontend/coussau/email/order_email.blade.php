<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Email template</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin: 0;font-family: 'Montserrat', sans-serif;">
	<table style="padding: 10px;max-width: 1024px;margin: 50px auto;background: #fff;box-shadow: 0px 4px 20px rgb(0 0 0 / 10%);border-spacing: 0px;">
		<tr>
			<td>
				<table>
					<tr>
						<td>
							<img src="{{ asset('public/frontend/images/logo.png') }}" alt="logo" style="width: 200px;">
						</td>
					</tr>
					<tr>
						<td>
							<h2 style="margin: 10px 0px;font-size: 20px;">Bestellung in Bearbeitung</h2>
							<h3 style="margin: 10px 0px;font-size: 20px;font-weight: 400;">Sehr geehrter Kunde, sehr geehrte Kundin,</h3>
							<h3 style="margin: 10px 0px;font-size: 20px;font-weight: 400;">Nochmals vielen Dank für Ihre Bestellung! Wir möchten Ihnen gerne erklären, wie unsere Plattform funktioniert:</h3>
						</td>
					</tr>
					<tr>
						<td>
							<table>
								<tr style="vertical-align: top;">
									<td style="font-weight: 700;line-height: 30px;font-size: 14px;width: 30px;">I -</td>
									<td style="line-height: 30px;font-size: 14px;">Wir prüfen die Verfügbarkeit des/der Produkte(s) in Ihrer Bestellung.</td>
								</tr>
								<tr style="vertical-align: top;">
									<td style="font-weight: 700;line-height: 30px;font-size: 14px;width: 30px;">II -</td>
									<td style="line-height: 30px;font-size: 14px;">Innerhalb von 72 Arbeitsstunden erhalten Sie eine Bestätigung, in der wir Ihnen den zu zahlenden Endbetrag und die Zahlungsanweisungen mitteilen. (Einschließlich Transportkosten)</td>
								</tr>
								<tr style="vertical-align: top;">
									<td style="font-weight: 700;line-height: 30px;font-size: 14px;width: 30px;">III - </td>
									<td style="line-height: 30px;font-size: 14px;">Sie haben dann 72 Arbeitsstunden Zeit, uns Ihre Überweisung zu tätigen.</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<h2 style="margin: 0;margin-top: 20px;font-size: 20px;text-align: center;color: #C59B6B;">Wissenswert</h2>
							<h3 style="font-size: 14px;text-align: center;line-height: 24px;font-weight: 400;">Ihre Bestellung wird erst dann bestätigt, wenn wir Ihre Überweisung erhalten haben. Wenn Ihre Überweisung nicht innerhalb von 5 Arbeitstagen auf dem Konto des Ateliers Coussau von Au eingegangen ist, wird die Bestellung storniert. Wenn Sie Schwierigkeiten haben, informieren Sie uns bitte so schnell wie möglich, damit Ihre Bestellung nicht storniert wird. </h3>
							<h2 style="margin-top: 35px;font-size: 18px;margin-bottom: 0px;">4- Kontoinformationen:</h2>
							<p style="margin: 5px 0px;line-height: 24px;font-size: 14px;">Kontoinhaber: L'atelier Coussau von Au<br>Catherine Coussau von Au <br>IBAN: DE48 6001 0070 0971 9577 04<br>BIC: PBNKDEFF<br>Name der Bank: Postbank Stuttgart</p>
						</td>
					</tr>
				</table>
				<table style="width: 100%;">
					<tr>
						<td>
							<h2 style="margin: 0;margin-top: 20px;font-size: 20px;text-align: center;color: #C59B6B;margin-bottom: 30px;">Zusammenfassung Ihrer Bestellung</h2>
						</td>
					</tr>
					<tr>
						<td>
							<table style="border: 1px solid #ddd;border-collapse: collapse;width: 100%;">
								<tr>
									<!--<th style="border: 1px solid #ddd;padding: 10px 5px;line-height: 22px;font-size: 14px;background: #C59B6B;">ARTIKEL</th>-->
									<th style="border: 1px solid #ddd;padding: 10px 5px;line-height: 22px;font-size: 14px;background: #C59B6B;">Bezeichnung</th>
									<th style="border: 1px solid #ddd;padding: 10px 5px;line-height: 22px;font-size: 14px;background: #C59B6B;">REFERENZ (Artikelnummer)</th>
									<th style="border: 1px solid #ddd;padding: 10px 5px;line-height: 22px;font-size: 14px;background: #C59B6B;">MENGENANGABEN</th>
									<th style="border: 1px solid #ddd;padding: 10px 5px;line-height: 22px;font-size: 14px;background: #C59B6B;">Preise</th>
								</tr>
                                @php $total = 0; $tot = 0 @endphp
        @if(session('cart'))
            @foreach(session('cart') as $id => $details)
                @php 
                $price2=str_replace('.', '', $details['price']);
                $price=str_replace(',', '.', $price2);
                $totalsingle= $price * $details['quantity'];
                $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
                $totalsingle= $formatter->formatCurrency($totalsingle, 'EUR');
                $tot += $price * $details['quantity']; 
				//$tot_with_transport=$tot+50;
                $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
                $total= $formatter->formatCurrency($tot, 'EUR');
				 @endphp
								<tr>
									<!--<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">
                                    <a href="{{ route('product_detail', $details['slug']) }}"><img style=
                                    'width: 100px;' src="{{ asset('public/frontend/images/product/'.$details['image']) }}" alt="cart-product-1"></a>
									</td>-->
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;"><a href="{{ route('product_detail', $details['slug']) }}">{{ $details['name'] }}</a></td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">{{ $details['article_number'] }}</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">{{ $details['quantity'] }}</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">{{ $totalsingle }} </td>
								</tr>
                                @endforeach
								
								
								
								
								<tr>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;" colspan="2">Gesamtpreis der Überweisung: Summe der Transportkosten:</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;" >1</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;" colspan="2" style="text-align: center;font-weight: 700;"> ? </td>
								</tr>
								<tr>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;" colspan="3">Gesamter Preis für ausgewählte Produkte:</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;" colspan="2" style="text-align: center;font-weight: 700;">{{ $total }} </td>
								</tr>
                                @endif
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<h2 style="margin: 0;margin-top: 20px;font-size: 20px;text-align: center;color: #C59B6B;margin-bottom: 30px;">Ihre Information </h2>
						</td>
					</tr>
					<tr>
						<td>
							<table style="text-align: left;border: 1px solid #ddd;border-collapse: collapse;width: 100%;">
								<tr style="background: #c59b6b12;">
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">RESERVIERUNG:</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">VERSANDADRESSE:<br>Catherine Coussau von Au Sonnenrain 2 Fichtenberg 74427 DE</td>
								</tr>
								<tr>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;"> DATUM DER RESERVIERUNG</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">RECHNUNGSANSCHRIFT:<br>Catherine Coussau von AuSonnenrain 2Fichtenberg 74427DE</td>
								</tr>
								<tr style="background: #c59b6b12;">
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">bestellung@antikemoebelkaufen.de</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">Gebrauchtgegenstände / Sonderregelung”, „Kunstgegenstände / Sonderregelung” oder „Sammlungsstücke und Antiquitäten / Sonderregelung” (Steuer je nach Gegenstand) </td>
								</tr>
								<!--<tr>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">RUFNUMMERN +491622373163</td>
									<td style="padding: 10px 5px;border: 1px solid #ddd;text-align: center;line-height: 22px;font-size: 14px;">The texts in red are the explanations of the VAT - we have several possibilities depending on the product purchased. For the tender and the availability it is necessary to put all three. When the price of transport is defined in the next mail, I will give the exact VAT of the product.  </td>
								</tr>-->
							</table>
						</td>
					</tr>
				</table>
				<table>
					<tr>
						<td style="text-align: center;">
						<div style="">
							<h1 style="margin: 0px 0px;text-align: center;line-height: 45px;color: #c59b6b;">Vielen Dank für Ihr Vertrauen und bis bald auf L'Atelier Coussau von Au. </h1>
							<!--<img src="{{ asset('public/frontend/images/email-1.png') }}" style="width: 100px;display:inline-block;">-->
						</div>
						</td>
					</tr>
					<tr>
						<td>
						
						<p>Mit freundlichen Grüßen, </p>
						<div style="width: 100%;float: left;">
							<img src="{{ asset('public/frontend/images/sign.png') }}" style="float: left;">
							
						</div>
						<p style="margin-top: 80px;">Catherine Coussau von Au</p>
						<img src="{{ asset('public/frontend/images/f-logo.png') }}" class="logo">
						</td>
					</tr>
					<tr>
						<td>
						<h3 style="margin-top: 35px;font-size: 18px;margin-bottom: 0px;">Adresse: Sonnenrain 2</h3>
						<p style="margin: 5px 0px;line-height: 24px;font-size: 14px;">74427 Fichtenberg <br>
						Tel: +49 (0) 7971 978 66 96<br>
						Mob: +49 (0) 162 23 73 163<br>
						E-Mail: <a href="mailto:info@antikemoebelkaufen.de" style="color: #C59B6B;">info@antikemoebelkaufen.de</a><br>
						Web: <a href="#" style="color: #C59B6B;">www.antikemoebelkaufen.de</a><br>
						USt-ID: DE342875478
						</p>
						</td>
					</tr>
					<tr>
						<td>
						<p style="font-size: 18px;font-weight: 700;">Zur Beachtung:</p>
						<p style="line-height: 24px;font-size: 14px;">Diese E-Mail enthält vertrauliche und/oder rechtlich geschützte Informationen. Wenn Sie nicht der richtige Adressat sind oder diese E-Mail irrtümlich erhalten haben, informieren Sie bitte den Absender und vernichten Sie diese Mail. Das unerlaubte Kopieren sowie die unbefugte Weitergabe dieser Mail ist nicht gestattet.</p>
						<p style="line-height: 24px;font-size: 14px;">Über das Internet versandte E-Mails können unter fremden Namen erstellt oder deren Inhalt verändert werden. Aus diesem Grund sind unsere als E-Mail versendeten Nachrichten grundsätzlich keine rechtlich verbindlichen Erklärungen. Der Inhalt unserer E-Mails nebst Anlagen ist vertraulich und unter bestimmten Umständen urheberrechtlich geschützt. Der Inhalt ist ausschließlich an einen bestimmten Empfänger gerichtet.</p>
						<p style="line-height: 24px;font-size: 14px;">Wir verwenden aktuelle Virenschutzprogramme und weitere Schutzmechanismen. Für Schäden, die dem Empfänger gleichwohl durch, von uns zugesendte E-Mails entstehen, schließen wir jede Haftung aus.</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>