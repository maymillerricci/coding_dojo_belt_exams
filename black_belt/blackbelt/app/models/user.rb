class User < ActiveRecord::Base
	EMAIL_REGEX = /\A([^@\s]+)@((?:[-a-z0-9]+\.)+[a-z]+)\z/i

	validates :first_name, presence: true,
							length: {within: 2..50}

	validates :last_name, presence: true,
							length: {within: 2..50}
	
	validates :email, presence: true,
						format: {with: EMAIL_REGEX, message: "incorrect email format"},
						uniqueness: {case_sensitive: false}
	
	validates :password, presence: true,
							length: {within: 6..20}

	before_save {self.email = email.downcase}
	has_secure_password
	has_many :posts
	has_many :likes
end
