<html>
  <link rel="stylesheet" href="css/org/pdf.css">
  <body>
  <h2><img src="img/logo-main.png"></h2>
  <p class="dateTab">{{ date('Y-m-d') }}</p>
    <table style="width:100%">
      <tr>
        <th>Name</th>
        <th>Position</th>
        <th>Votes</th>
      </tr>
      @foreach($data as $result)
        <tr>
            <td>{{ $result->Name }}</td>
            <td>{{ $result->Position }}</td>
            <td>{{ $result->Votes }}</td>
        </tr>
      @endforeach
    </table>
    <p>
      No. Of registered voters: {{ $NoOfVoters }}<br>
      No. Of voters who successfully voted: {{ $NoOfVoted }}<br>
      No. Of voters who did not vote: {{ $PendingVoters }}
      <br><br>
    
      <span class="tab2">  {{ $sign->fname }} {{ $sign->lname }} <span class="tab1"> {{ $sign->NoS }}<br>
         Office In-Charge <span class="tab3"> {{ $sign->PoS }}
    </p>

  </body>
</html>

<style>
    .tab1 {
      margin-left: 420px;
    }
    .tab2 {
      margin-left: 15px;
    }
    .tab3 {
      margin-left: 435px;
    }
    .dateTab{
      margin-left: 620px;
    }
</style>