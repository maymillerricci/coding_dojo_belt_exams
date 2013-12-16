class LikesController < ApplicationController
	def create
		if (Like.where(user_id: session[:user_id], post_id: params[:post_id])).count > 0
			redirect_to :back, notice: "You already liked this post."
		else
			@like = Like.new
			@like.user_id = session[:user_id]
			@like.post_id = params[:post_id]
			@like.save
	    	redirect_to :back, notice: "Your like was successfully recorded."
	    end
    end
end
