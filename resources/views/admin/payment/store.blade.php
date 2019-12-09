@extends('admin.layouts.layout-basic')

@section('scripts')
    <script src="/assets/admin/js/users/users.js"></script>
@stop

@section('content')
    <Payment/>
@stop
<script>
    import Payment from "../../../admin/js/components/Payment";
    export default {
        components: {Payment}
    }
</script>