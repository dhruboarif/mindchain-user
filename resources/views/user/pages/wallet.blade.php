@extends('user.layouts.master')


@section('user_content')
<!DOCTYPE html>

    <!-- Main tabs -->
    <div class="container" style="background: url({{ asset('wallet/tecture.png') }});">
      <!-- Main tabs -->
      <div class="tab-buttons row text-center">
        <div class="tab-button col-sm-4" onclick="openTab(event, 'depositTab')"><img class="wallet-img dwt-g mr-3" src="{{ asset('wallet/assets/icons/deposit_money-g.png')}}" alt=""><img class="wallet-img dwt-b mr-3" src="{{ asset('wallet/assets/icons/deposit_money_b.png')}}" alt=""> <span> Deposit</span></div>
        <div class="tab-button col-sm-4" onclick="openTab(event, 'withdrawTab')"><img class="wallet-img dwt-g mr-4" src="{{ asset('wallet/assets/icons/money_withdraw_g.png')}}" alt=""><img class="wallet-img dwt-b mr-4" src="{{ asset('wallet/assets/icons/money_withdraw_b.png')}}" alt=""><span>Withdraw</span> </div>
        <div class="tab-button col-sm-4" onclick="openTab(event, 'transferTab')"><img class="wallet-img dwt-g mr-4" src="{{ asset('wallet/assets/icons/transfer_g.png')}}" alt=""><img class="wallet-img dwt-b mr-4" src="{{ asset('wallet/assets/icons/transfer_b.png')}}" alt=""><span>Transfer Fund</span></div>
      </div>
    
      <!-- Main tab content 1 -->
      <div id="depositTab" class="tab">
        <div class="tab-content ">
          <div class="sub-tab-buttons row text-center">
             
            <button type="button" class="sub-tab-button col-sm-4" data-bs-toggle="modal" data-bs-target="#depositusd">Deposit USDT </button>
            <button type="button" class="sub-tab-button col-sm-4" data-bs-toggle="modal" data-bs-target="#addfund2">Deposit MUSD </button>
            <button type="button" class="sub-tab-button col-sm-4" data-bs-toggle="modal" data-bs-target="#addtoken2">Deposit MIND </button>
          </div>
        </div>
      </div>
@include('user.modals.depositusd')
@include('user.modals.addfundmodal2')
@include('user.modals.addtokenmodal2')

      <!-- Main tab content 2 -->
      <div id="withdrawTab" class="tab">
        <div class="tab-content ">
          <div class="sub-tab-buttons row text-center">
            <button type="button" class="sub-tab-button col-sm-4" data-bs-toggle="modal" data-bs-target="#withdrawusd">Withdraw USDT</button>
            <button type="button" class="sub-tab-button col-sm-4">Withdraw MUSD</button>
            <button type="button" class="sub-tab-button col-sm-4">Withdraw MIND</button>
          </div>
        </div>
      </div>
@if(Auth::user()->status == 1)
@include('user.modals.withdraw_usd_modal')
@endif
          <!-- Main tab content 3 -->
      <div id="transferTab" class="tab">
        <div class="tab-content ">
          <div class="sub-tab-buttons row text-center">
            <button type="button" class="sub-tab-button col-sm-4">Transfer USDT</button>
            <button type="button" class="sub-tab-button col-sm-4">Transfer MUSD</button>
            <button type="button" class="sub-tab-button col-sm-4">Transfer MIND</button>
          </div>
        </div>

      </div>
    </div>



@push('scripts')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    // Function to handle main tab switching
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tab");
        for (i = 0; i < tabcontent.length; i++) {
            console.log(tabcontent[i]);
            tabcontent[i].classList.remove("active");
        }
        tablinks = document.getElementsByClassName("tab-button");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].classList.remove("active");
        }
        document.getElementById(tabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }

    // Function to handle sub-tab switching
    function openSubTab(evt, subTabName) {
        var i, subTabContent, subTabButtons;
        subTabContent = document.getElementsByClassName("sub-tab-content");
        for (i = 0; i < subTabContent.length; i++) {
            subTabContent[i].classList.remove("active");
        }
        subTabButtons = document.getElementsByClassName("sub-tab-button");
        for (i = 0; i < subTabButtons.length; i++) {
            subTabButtons[i].classList.remove("active");
        }
        document.getElementById(subTabName).classList.add("active");
        evt.currentTarget.classList.add("active");
    }
    
    $('#depositusd').toogle('show'); 
    $('#withdrawbonus').toogle('show'); 

</script>
@endpush
@endsection