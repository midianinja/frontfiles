<template>
<div class="form-wrapper clearfix">
	<div class="input col-md-12">
		<display-error :error="errors['title']"></display-error>
		<input type="text" name="title" id="title" class="form-control" placeholder="Title" v-model="upload.data.title" maxlength="40"/>
	</div>
	<div class="input col-md-12">
		<display-error :error="errors['description']"></display-error>
		<textarea name="description" id="description" class="form-control" placeholder="Description" v-model="upload.data.description"></textarea>
		
	</div>
	
	<div class="input col-md-6">
		<display-error :error="errors['where']"></display-error>
		<places-input :options="{name:'where',className:'form-control',placeholder:'#Where'}" :content="upload.data.where" @change="changeWhere"></places-input>
		
	</div>
	<div class="input col-md-5 col-md-offset-1">
		<display-error :error="errors['when']"></display-error>
		<date-picker :option="options" class="form-control" @change="changeDate" :date="date" :limit="limit"></date-picker>
	</div>
	<div class="input col-md-12 tag-input">
		<display-error :error="errors['what']"></display-error>
		<tag-input placeholder="#What #Why #How" class="form-control" :tags="what" @change="changeWhat" :name="'whatTags'"></tag-input>
		
	</div>
	<div class="radio-wrapper clearfix">
		<display-error :error="upload.errors['drive']"></display-error>
		<div class="radio">
			<input type="radio" name="drive" value="dropbox" class="form-control"  id="dropbox" v-model='upload.data.drive'>
		 	<label class="" for="dropbox">Dropbox</label>
		 			
		</div>		
	</div>

</div>

</template>

<script>
import datePicker from 'vue-datepicker'
import  displayError from './../inputs/display-error'
import moment from 'moment'
export default {

	name: 'upload-form',
	components:{
		displayError,
		datePicker
	},
	props:{
		upload:{
			required:true,
			type:Object
		},
		errors:{
			required:false,
			type:Object
		},
		who:{
			required:true,
			type:Array
		},
		what:{
			required:true,
			type:Array
		}
	},
	data () {
		return {
			limit:[{
				type:'fromto',
				to:moment().format('YYYY-MM-DD')
			}],
			options:{
				placeholder:'#When',
				type: 'day',
        		week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        		month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        		format: 'YYYY-MM-DD',
        		inputStyle: {
		          	display: 'block',
					width: '100%',
					height: 'auto',
					border:'none'

        		}
			}
		}
	},
	methods:{
		changeDate(d){
			this.date.time= d
  			this.upload.data.when = moment(d).format('YYYY-MM-DD')
  		},
  		changeWhat(tags){
  			this.$emit('changeWhat',tags)
  		},
  		changeWho(tags){
  			this.$emit('changeWho',tags)
  		},
  		changeWhere(data){
				this.upload.data.where=data.location
				this.upload.data.lat=data.lat
				this.upload.data.lng=data.lng
		},
	},
	mounted(){
		this.upload.data.drive="dropbox"
	},
	computed:{
		date(){
			return {time:this.upload.data.when}
		}
	}
};
</script>

<style lang="scss">
.form-wrapper{
	display:block;

	::-webkit-input-placeholder { /* Chrome */
  		color: red;
	}	
	h3{
		padding:1rem 0;
		color:blue;
	}
	p{
		width:50%;
		padding:.5rem;
		float:left;
	}
	
	.tag-input{
		height:6rem;
		margin-bottom:1rem;
	}
	.radio-wrapper{
		width:100%;
		float:left;
		display:none;
	}
	.radio{
		display:flex;
		width:50%;

		label{
				flex:1;
				background:#eee;
				text-align:center;
				padding:1rem;
			}
	
		input[type='radio']{
			visibility:hidden;
			flex:1;
			margin: 0px;
			

			&:checked  + label{
				background-color:blue;
				color:white;
			
			}
		}		
	}

	.cov-date-body{
		background-color:blue !important;
	}
}

</style>