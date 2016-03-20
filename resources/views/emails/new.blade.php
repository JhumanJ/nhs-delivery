<h1>Hello {{$user->firstName}}</h1>

</br>

<p>You just received a new package. Please check details online, and collect it at the reception desk.</p>

</br>

<h4>Package description: </h4>
<p>(Please check online, details may have been changed)</p>
<p>Reference: {{$delivery->reference}}</p>
<p>Description: {{$delivery->description}}</p>
<p>Size: {{$delivery->size}}</p>
<p>Weight: {{$delivery->weight}}</p>

</br>

<p>A picture is also available online.</p>

<p>Have a great day.</p>

<p></p>