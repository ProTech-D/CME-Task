<div class="card">
    <div class="card-header">
        Add CLients
    </div>
    <div class="card-title ml-4 my-2">
        <p v-if="errors.length >0">
            <b>Please correct the following error(s):</b>
        <ul>
            <li v-for="error in errors">@{{ error }}</li>
        </ul>
        </p>
        <form id="regForm" @submit="submitForm" @submit.prevent="checkForm">
        @csrf
            <input type="text" v-model="form.name" class="form-control my-2" placeholder="User Name" id="UserName" style="width: 99%;">
            <input type="email" v-model="form.email" class="form-control my-2" placeholder="User Email" id="UserEmail" style="width: 99%;">
            <input type="company" v-model="form.company" class="form-control my-2" placeholder="Company" id="company" style="width: 99%;">
            <button type="submit" class="btn btn-success" id="btn_register">Add Record</button>
        </form>
    </div>