
  /*
  * Description: With the given credentials validate if is a vlaid email/pass combination.
  * Highlight the inputs if error or redirect to userslist if success
  * @param void
  * @return boolean
  */
  function loginUser()
  {
    var useremail = document.getElementById("useremail").value;
    var userpassword = document.getElementById("userpassword").value;
    var rememberuser = document.getElementById("rememberuser").checked;

    var valid = validateLoginFields(useremail, userpassword);

    if(!valid) {
      $("#error_reporting").show();
      return false;
    }
    var data = [];
    data.push({ useremail: useremail, userpassword: userpassword, rememberuser: rememberuser });
    var result = makeRequest("POST", data[0], "auth", "userslist.html");
  }

  /*
  * Description: Populate the students list and update the pagination
  * @param int initial = 0
  * @param string action
  * @return void
  */
  function getUserList(initial = 0, action) {

    document.getElementById("students-list").innerHTML = "";
    var table = document.getElementById("students-list");
    var userauth = getCookieData();

    if(userauth == "") {
      window.location.replace("/");
    }

    $.ajax({
      url: "users",
      type: "GET",
      dataType: "text",
      data: { initial: initial, token: userauth },
      success: function(result) {

        data = JSON.parse(result);
        var prev = action == 'initial' ? initial : initial - 5;
        var next = initial + 5;
        var pagesTotal = Math.ceil(data['counter']/5);
        var pagesCurrent = Math.ceil((initial + 5)/5);

        document.getElementById('prev').setAttribute('onclick','getUserList(' + prev + ')');
        document.getElementById('next').setAttribute('onclick','getUserList(' + next + ')');
        document.getElementById('current').innerHTML = pagesCurrent + " page of " + pagesTotal;

        for (let item of data['data']) {
          row = table.insertRow(-1);
          for (let key in item) {
            var cell = row.insertCell(-1);
            cell.innerHTML = item[key];
          }
        }
      },
      error:function(){
        alert("error");
      }
    });
  }

  /*
  * Description: Log out the user. Removes the token from db
  * @param void
  * @return void
  */
  function logout()
  {
    var userauth = getCookieData();
    var result = makeRequest("DELETE", userauth, "auth", "/");
  }

  /*
  * Description: validate email and password fields
  * @param email string
  * @param pass string
  * @return boolean
  */
  function validateLoginFields(email, pass)
  {
    //Validate fields
    const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var valid_email = mailformat.test(String(useremail).toLowerCase());

    return valid_email || userpassword
  }

  /*
  * Description: validate if a cookie exists and contain a token. It does not validate the token
  * authenticity
  * @param void
  * @return void
  */
  function validateCredentials(redirect)
  {
    var validuserauth = getCookieData();
    if(validuserauth != "") {
      window.location.replace(redirect);
    }
    return false;
  }

  /*
  * Description: Create an asynchronous call to the API using POST, GET and DELETE
  * @param type string (POST, GET, DELETE)
  * @param data array
  * @param url string
  * @return result boolean
  */
  function makeRequest(type, data, url, redirectTo)
  {
    $.ajax({
      url: url,
      type: type,
      dataType: "text",
      data: data,
      success: function(result) {
        window.location.replace(redirectTo);
      },
      error:function(){
        $("#error_reporting").show();
      }
    });
  }

  /*
  * Description: Set a cookie with a temp token, for 30 days and with a root "/" path
  * @param void
  * @return void
  */
  function setCookie()
  {
    var rand = function() {
      return Math.random().toString(36).substr(2);
    };

    var exp = new Date();
    exp.setTime(d.getTime() + (30*24*60*60*1000));
    var expires = "expires="+ exp.toUTCString();
    document.cookie = "userauth=123456789;" + expires + ";path=/";
  }

  /*
  * Description: Search for a cookie an return its value or boolean if empty/not exists
  * @param void
  * @return boolean | array
  */
  function getCookieData()
  {
    var name = "userauth=";
    var dc = decodeURIComponent(document.cookie);
    var cookieC = dc.split(';');

    for(var i = 0; i < cookieC.length; i++) {
      var current = cookieC[i];
      while (current.charAt(0) == ' ') {
        current = current.substring(1);
      }
      if (current.indexOf(name) == 0) {
        return current.substring(name.length, current.length);
      }
    }

    return "";
  }
