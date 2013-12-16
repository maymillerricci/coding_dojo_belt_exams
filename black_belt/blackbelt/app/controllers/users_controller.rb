class UsersController < ApplicationController
  def index
  	@users = User.all
  end

  def new
  	@user = User.new
  end

  def create
  	@user = User.new(user_params)
  	if @user.save
      sign_in @user
  		redirect_to users_path, notice: "User was successfully created."
  	else
  		flash[:errors_register] = @user.errors.full_messages
      	redirect_to :back
  	end
  end

  def show
    @user = User.find(params[:id])
  end

  def edit
  end

  private
  	def user_params
  		params.require(:user).permit(:first_name, :last_name, :email, :password, :password_confirmation)
  	end
end
