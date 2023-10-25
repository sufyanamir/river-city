@include('layouts.header')
<style>
    input[type=checkbox]+label {
        display: block;
        margin: 0.2em;
        cursor: pointer;
        padding: em;
    }

    input[type=checkbox] {
        display: none;
    }

    input[type=checkbox]+label:before {
        content: "\2713";
        border: 1.5px solid #1C274C;
        border-radius: 25%;
        display: inline-block;
        width: 1.3em;
        height: 1.3em;
        padding-left: 0.2em;
        padding-bottom: 0.2em;
        margin-right: 0.2em;
        vertical-align: bottom;
        color: transparent;
        transition: .2s;
    }

    input[type=checkbox]+label:active:before {
        transform: scale(0);
    }

    input[type=checkbox]:checked+label:before {
        background-color: #71E25E;
        border-color: #1C274C;
        color: #000000;
    }
</style>
<input type="checkbox" id="fruit1" name="-1" value="">
<label for="fruit1">User</label>

@include('layouts.footer')
