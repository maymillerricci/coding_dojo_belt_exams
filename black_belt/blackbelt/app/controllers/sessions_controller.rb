class SessionsController < ApplicationController
  def new

  end

  def create
  	# user = User.find_by(email: params[:user][:email]).try(:authenticate, params[:user][:password])
  	# if email address is blank
  	if params[:session][:email].blank?
  		flash[:errors_login] = "Email must not be blank"
  		redirect_to :back
  	# if email address does not exist in database
  	elsif User.find_by(email: params[:session][:email]).nil?
  		flash[:errors_login] = "A user with this email address does not exist in the database"
		redirect_to :back
  	# if email address exists in the database but password does not match
  	elsif !(User.find_by(email: params[:session][:email]).try(:authenticate, params[:session][:password]))
  		# redirect_to new_user_path, :flash => { :error => 'Email and password don\'t match.' }
  		flash[:errors_login] = "Email and password do not match"
  		redirect_to :back
  	# otherwise, email address and password match -> success!
  	else
      user = User.find_by(email: params[:session][:email]).try(:authenticate, params[:session][:password])
  		sign_in user
		  redirect_to users_path
  	end
  end

  def destroy
    sign_out
    redirect_to users_path
  end
end