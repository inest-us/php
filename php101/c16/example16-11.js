<script>
pets = ["Cat", "Dog", "Rabbit", "Hamster"]
pets.forEach(output)

function output(element, index, array)
{
	document.write("Element at index " + index + " has the value " +
		element + "<br />")
}
</script>
