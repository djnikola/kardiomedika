<div class="title_text">
	<h2>Zakazivanje pregleda on-line</h2>
	</div>	

	<div class="contact-form">
        
        <table cellspan="0" cellpadding="0" border="0">
            <tr>
                <td><label><p>{[$labels.name]}:</p></label></td>
                <td>
                <strong>{[$contact_obj->name]}&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td><label><p>Prezime:</p></label></td>
                <td>
                <strong>{[$contact_obj->lname]}&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td><label><p>{[$labels.telephone]}:</p></label></td>
                <td>
                <strong>{[$contact_obj->phone]}&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td><label><p>Godina rođenja:</p></label></td>
                <td>
                <strong>{[$contact_obj->birth_year]}&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td><label><p>Email:</p></label></td>
                <td>
                <strong>{[$contact_obj->email]}&nbsp;</strong>
                </td>
            </tr>
            <tr>
            	<td><p>Datum pregleda:</p></td>
            	<td>
            		<strong>{[$contact_obj->from_date]}&nbsp;</strong>
            	</td>
            </tr>
            <tr>
            	<td><p>Alternativni datum pregleda:</p></td>
            	<td>
            		<strong>{[$contact_obj->to_date]}&nbsp;</strong>	
            	</td>
            </tr>
            <tr>
                <td><label><p>Ime doktora:</p></label></td>
                <td>
                <strong>{[$contact_obj->doctor_name]}&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td>Vrsta pregleda:</td>
                <td>
                	<strong>{[$contact_obj->examination]}&nbsp;</strong>
                </td>
            </tr>
            <tr>
                <td><label><p>Vreme pregleda:</p></label></td>
                <td>
                	{[if $contact_obj->daily_period == "am"]}
                		<strong>Prepodnevni termin&nbsp;</strong>	
                	{[else]}
                		<strong>Popodnevni termin&nbsp;</strong>
                	{[/if]}
                </td>
            </tr>
            <tr>
                <td><label><p>Opis tegoba (razlog javljanja):</p></label></td>
                <td>
                	<strong>{[$contact_obj->message]}&nbsp;</strong>
                </td>
            </tr>			
        </table>        
	</div>