<h1>Hello {{$user->firstName}}</h1>

</br>

<p>This email confirms that you came and collect your package. Your signature is also available online.</p>

</br>

<h4>Package description: </h4>

<p>Reference: {{$delivery->reference}}</p>
<p>Description: {{$delivery->description}}</p>
<p>Size: {{$delivery->size}}</p>
<p>Weight: {{$delivery->weight}}</p>

</br>

<p>A picture is also available online.</p>

<p>Have a great day.</p>

<p></p>