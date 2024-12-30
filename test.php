<script>
function qget () {
  // (A) APPEND DATA
  var data = new URLSearchParams();
  data.append("pid", "$id");
  data.append("email", "jon@doe.com");
 
  // (B) URL + REDIRECT
  var url = "test2.php?" + data.toString();
  location.href = url;
}
</script>
<input type="button" value="Go" onclick="qget()">