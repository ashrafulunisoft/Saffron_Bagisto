# PHASE 4 COMPREHENSIVE IMPLEMENTATION GUIDE
## Authentication and Security Implementation (January 16-29, 2026)

---

### 1. INTRODUCTION TO PHASE 4

Phase 4 of the Saffron Sweets and Bakeries E-Commerce Platform implementation focuses on establishing a robust, secure, and user-friendly authentication and security system. This critical phase forms the foundation of user trust and data protection, ensuring secure access to all platform features while maintaining compliance with Bangladesh-specific requirements including mobile-first authentication and local data protection regulations.

The authentication and security system will accommodate the full spectrum of user access scenarios while maintaining flexibility for future growth and security enhancements. Particular attention is given to optimizing for mobile network conditions common in Bangladesh and ensuring seamless user experience across all devices.

**Timeline:** January 16-29, 2026 (2 Weeks)  
**Primary Focus:** Authentication system, security implementation, and user management  
**Developer Workload:** Full-time solo development (40 hours/week)  

---

### 2. OVERVIEW OF PHASE 4 OBJECTIVES AND SCOPE

#### Primary Objectives
- Implement comprehensive user authentication system with JWT tokens and refresh mechanisms
- Create secure user registration with email/phone verification and social login options
- Establish robust password security with reset flows and two-factor authentication
- Build role-based access control (RBAC) system with hierarchical permissions
- Implement API security with rate limiting, CORS, and input validation
- Create user profile management with secure data handling
- Develop admin authentication with enhanced security measures
- Establish security monitoring and alerting systems
- Implement data protection measures compliant with Bangladesh regulations
- Conduct comprehensive security verification and testing

#### Scope of Implementation
- JWT token generation, validation, and refresh token mechanisms
- User registration with validation and verification workflows
- Password security implementation with strength requirements and 2FA
- Role-based access control with permission management
- API security middleware and protection mechanisms
- User profile management with secure data handling
- Admin authentication with enhanced security features
- Security monitoring and logging systems
- Data protection and encryption implementation
- Security testing and verification procedures

#### Exclusions
- Frontend authentication UI components (handled in Phase 7)
- Payment gateway authentication (handled in Phase 6)
- Third-party service authentication beyond social login (handled in later phases)
- Advanced security features like biometric authentication (future enhancement)

---

### 3. DEPENDENCIES ON PREVIOUS PHASES AND IMPACT ON SUBSEQUENT PHASES

#### Dependencies on Previous Phases
- **Phase 1 Completion:** Development environment with security tools must be fully configured
- **Phase 2 Completion:** Backend framework with security middleware must be established
- **Phase 3 Completion:** User management database schema must be implemented
- **Technology Stack:** NestJS framework with TypeScript security features must be initialized
- **Development Tools:** Security testing tools and monitoring must be operational

#### Impact on Subsequent Phases
- **Phase 5 (E-Commerce):** Authentication system enables secure user access to business features
- **Phase 6 (Payments):** Secure authentication enables protected payment transactions
- **Phase 7 (Frontend):** Authentication APIs provide secure frontend integration
- **Phase 8 (Delivery):** Role-based access controls delivery service permissions
- **Phase 9 (Testing):** Security verification becomes critical component of testing strategy
- **Phase 10 (Optimization):** Authentication performance impacts overall system optimization

---

### 4. TECHNOLOGY STACK REQUIREMENTS

#### Authentication Framework
- **JWT (JSON Web Tokens)**: Token-based authentication with:
  - Access tokens with configurable expiration (15 minutes default)
  - Refresh tokens with longer expiration (7 days default)
  - Token signing with RS256 algorithm
  - Token blacklisting for logout scenarios
  - Secure token storage and transmission

- **bcrypt**: Password hashing with:
  - Salt rounds configuration (12 rounds minimum)
  - Secure password comparison mechanisms
  - Password strength validation integration
  - Hash timing attack prevention

#### OAuth 2.0 Integration
- **Passport.js**: Authentication middleware for:
  - Google OAuth 2.0 integration
  - Facebook Login integration
  - Social profile mapping and user creation
  - Token exchange and user linking

#### Security Libraries
- **Helmet.js**: Security headers configuration
- **express-rate-limit**: API rate limiting
- **cors**: Cross-origin resource sharing configuration
- **joi**: Input validation and sanitization
- **express-validator**: Request validation middleware

#### Bangladesh-Specific Services
- **SMS Gateways**: Integration with:
  - Teletalk for SMS verification
  - Robi Axiata for bulk messaging
  - Banglalink for enterprise messaging
  - Local SMS provider abstraction layer

- **Email Services**: Integration with:
  - SendGrid for transactional emails
  - Local email provider options
  - Email template management
  - Delivery tracking and analytics

---

### 5. BANGLADESH-SPECIFIC REQUIREMENTS

#### Mobile Number Verification
- **Bangladesh Phone Format**: Support for +880 and 01 prefixes
- **Local Validation**: Regex patterns for Bangladeshi mobile numbers
- **SMS Gateway Integration**: Multiple provider support with fallback
- **Cost Optimization**: Local SMS routing for reduced costs
- **Delivery Tracking**: SMS delivery status monitoring

#### Bilingual Support
- **Bengali Error Messages**: All security messages in Bengali and English
- **Localized Verification**: Phone/email verification in local languages
- **Cultural Adaptation**: Authentication flows adapted to local preferences
- **RTL Support**: Right-to-left text support for Bengali script

#### Mobile-First Authentication
- **SMS-Based Login**: Primary authentication via mobile number
- **USSD Support**: Unstructured Supplementary Service Data integration
- **Offline Capability**: Authentication token caching for poor connectivity
- **Low Data Usage**: Optimized authentication flows for mobile networks
- **Touch ID**: Biometric authentication support for mobile devices

#### Local Compliance
- **Data Residency**: User data stored within Bangladesh borders
- **Local Regulations**: Compliance with Bangladesh Digital Security Act
- **Privacy Protection**: Enhanced user privacy measures
- **Audit Requirements**: Local compliance audit trails
- **Reporting Standards**: Bangladesh-specific security reporting

---

## MILESTONE 1: USER AUTHENTICATION IMPLEMENTATION

### Objectives and Goals
Implement a secure and scalable JWT-based authentication system with refresh token mechanisms, password hashing, and session management that supports both web and mobile access patterns.

### Detailed Subtasks with Implementation Steps

#### 1.1 Create JWT Token Generation and Validation
- Implement JWT service with RS256 signing algorithm
- Create access token generation with configurable expiration
- Implement refresh token mechanism for prolonged sessions
- Set up token validation middleware
- Create token blacklisting system for logout scenarios

```typescript
// JWT Service Implementation
@Injectable()
export class JwtService {
  constructor(
    @InjectRepository(User)
    private userRepository: Repository<User>,
    @InjectRepository(RefreshToken)
    private refreshTokenRepository: Repository<RefreshToken>,
  ) {}

  async generateTokens(user: User) {
    const payload = { 
      sub: user.id, 
      email: user.email, 
      role: user.role 
    };
    
    const accessToken = this.jwtService.sign(payload, {
      expiresIn: '15m',
      secret: process.env.JWT_ACCESS_SECRET,
    });
    
    const refreshToken = this.jwtService.sign(payload, {
      expiresIn: '7d',
      secret: process.env.JWT_REFRESH_SECRET,
    });
    
    // Save refresh token to database
    await this.refreshTokenRepository.save({
      token: refreshToken,
      user,
      expiresAt: new Date(Date.now() + 7 * 24 * 60 * 60 * 1000),
    });
    
    return { accessToken, refreshToken };
  }

  async validateAccessToken(token: string) {
    try {
      const decoded = this.jwtService.verify(token, {
        secret: process.env.JWT_ACCESS_SECRET,
      });
      return decoded;
    } catch (error) {
      throw new UnauthorizedException('Invalid access token');
    }
  }

  async validateRefreshToken(token: string) {
    const refreshToken = await this.refreshTokenRepository.findOne({
      where: { token },
      relations: ['user'],
    });
    
    if (!refreshToken || refreshToken.expiresAt < new Date()) {
      throw new UnauthorizedException('Invalid refresh token');
    }
    
    return refreshToken.user;
  }
}
```

#### 1.2 Implement Password Hashing and Verification
- Set up bcrypt service with secure configuration
- Implement password hashing with salt rounds (12 minimum)
- Create password comparison mechanisms
- Add password strength validation
- Implement secure password reset functionality

```typescript
// Password Service Implementation
@Injectable()
export class PasswordService {
  constructor() {}

  async hashPassword(password: string): Promise<string> {
    const saltRounds = 12;
    return bcrypt.hash(password, saltRounds);
  }

  async comparePassword(password: string, hash: string): Promise<boolean> {
    return bcrypt.compare(password, hash);
  }

  validatePasswordStrength(password: string): { isValid: boolean; errors: string[] } {
    const errors = [];
    
    if (password.length < 8) {
      errors.push('Password must be at least 8 characters long');
    }
    
    if (!/[A-Z]/.test(password)) {
      errors.push('Password must contain at least one uppercase letter');
    }
    
    if (!/[a-z]/.test(password)) {
      errors.push('Password must contain at least one lowercase letter');
    }
    
    if (!/[0-9]/.test(password)) {
      errors.push('Password must contain at least one number');
    }
    
    if (!/[!@#$%^&*]/.test(password)) {
      errors.push('Password must contain at least one special character');
    }
    
    return {
      isValid: errors.length === 0,
      errors,
    };
  }
}
```

#### 1.3 Create Login and Logout Functionality
- Implement secure login endpoint with rate limiting
- Create logout functionality with token blacklisting
- Add login attempt tracking and lockout mechanisms
- Implement session management with Redis
- Create authentication middleware for protected routes

```typescript
// Auth Controller Implementation
@Controller('auth')
export class AuthController {
  constructor(
    private authService: AuthService,
    private passwordService: PasswordService,
  ) {}

  @Post('login')
  @UseGuards(RateLimitGuard)
  async login(@Body() loginDto: LoginDto) {
    const user = await this.authService.validateUser(loginDto.email, loginDto.password);
    
    if (!user) {
      throw new UnauthorizedException('Invalid credentials');
    }
    
    const tokens = await this.authService.generateTokens(user);
    
    // Track login attempt
    await this.authService.trackLoginAttempt(loginDto.email, true);
    
    return {
      user: {
        id: user.id,
        email: user.email,
        role: user.role,
      },
      ...tokens,
    };
  }

  @Post('logout')
  @UseGuards(JwtAuthGuard)
  async logout(@Request() req: any) {
    const token = req.headers.authorization?.replace('Bearer ', '');
    
    // Blacklist token
    await this.authService.blacklistToken(token);
    
    // Clear session
    await this.authService.clearUserSession(req.user.id);
    
    return { message: 'Logged out successfully' };
  }
}
```

#### 1.4 Set Up Session Management
- Create Redis-based session storage
- Implement session timeout and cleanup
- Add concurrent session management
- Create session recovery mechanisms
- Implement session analytics and monitoring

```typescript
// Session Service Implementation
@Injectable()
export class SessionService {
  constructor(
    @InjectRedis() private readonly redis: Redis,
  ) {}

  async createSession(userId: string, deviceInfo: any) {
    const sessionId = uuidv4();
    const sessionData = {
      userId,
      deviceInfo,
      createdAt: new Date(),
      lastActivity: new Date(),
    };
    
    await this.redis.setex(
      `session:${sessionId}`,
      3600, // 1 hour
      JSON.stringify(sessionData),
    );
    
    return sessionId;
  }

  async validateSession(sessionId: string): Promise<any> {
    const sessionData = await this.redis.get(`session:${sessionId}`);
    
    if (!sessionData) {
      throw new UnauthorizedException('Invalid session');
    }
    
    const session = JSON.parse(sessionData);
    
    // Update last activity
    session.lastActivity = new Date();
    await this.redis.setex(
      `session:${sessionId}`,
      3600,
      JSON.stringify(session),
    );
    
    return session;
  }

  async clearSession(sessionId: string): Promise<void> {
    await this.redis.del(`session:${sessionId}`);
  }
}
```

#### 1.5 Implement Token Refresh Mechanism
- Create refresh token validation endpoint
- Implement automatic token refresh on frontend
- Add refresh token rotation security
- Create token expiration handling
- Implement concurrent session management

```typescript
// Token Refresh Implementation
@Injectable()
export class TokenRefreshService {
  constructor(
    private jwtService: JwtService,
    private refreshTokenRepository: Repository<RefreshToken>,
  ) {}

  async refreshToken(refreshToken: string) {
    const tokenData = await this.refreshTokenRepository.findOne({
      where: { token: refreshToken },
      relations: ['user'],
    });
    
    if (!tokenData || tokenData.expiresAt < new Date()) {
      throw new UnauthorizedException('Invalid refresh token');
    }
    
    // Generate new tokens
    const newTokens = await this.generateTokens(tokenData.user);
    
    // Invalidate old refresh token
    await this.refreshTokenRepository.delete({ id: tokenData.id });
    
    return newTokens;
  }

  async revokeRefreshToken(userId: string): Promise<void> {
    await this.refreshTokenRepository.delete({ userId });
  }
}
```

### Acceptance Criteria for Validation
- JWT tokens properly generated with RS256 signing algorithm
- Password hashing implemented with minimum 12 salt rounds
- Login endpoint protected with rate limiting (5 attempts per minute)
- Session management working with Redis integration
- Refresh token mechanism functioning with proper rotation
- Token blacklisting working for logout scenarios

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **JWT Implementation:** 4 hours
- **Password Security:** 4 hours
- **Login/Logout:** 4 hours
- **Session Management:** 2 hours
- **Testing and Validation:** 2 hours

### Required Resources
- JWT library (jsonwebtoken or equivalent)
- bcrypt library for password hashing
- Redis for session management
- Rate limiting middleware
- Security testing tools

### Validation Checkpoints and Testing Procedures
- Test JWT token generation and validation with various scenarios
- Verify password hashing and comparison security
- Test login rate limiting under load conditions
- Validate session management with concurrent users
- Test refresh token rotation and expiration handling

### Technical Specifications
- **JWT Algorithm:** RS256 with configurable expiration times
- **Password Hashing:** bcrypt with 12+ salt rounds
- **Session Storage:** Redis with 1-hour default timeout
- **Rate Limiting:** 5 attempts per minute, 15 per hour
- **Token Security:** Secure storage with httpOnly cookies

---

## MILESTONE 2: USER REGISTRATION SYSTEM

### Objectives and Goals
Create a comprehensive user registration system with validation, email/phone verification, social login integration, and CAPTCHA protection while ensuring compliance with Bangladesh-specific requirements.

### Detailed Subtasks with Implementation Steps

#### 2.1 Create User Registration with Validation
- Implement registration endpoint with comprehensive validation
- Add email and phone number uniqueness checks
- Create password strength validation
- Implement terms acceptance and privacy policy agreement
- Add account type selection (customer/business)

```typescript
// Registration DTO and Validation
export class RegisterDto {
  @IsEmail()
  @IsNotEmpty()
  email: string;

  @IsString()
  @IsNotEmpty()
  @MinLength(11)
  @MaxLength(20)
  @Matches(/^(\+880|01)[0-9]{9}$/, {
    message: 'Phone number must be a valid Bangladesh number'
  })
  phoneNumber?: string;

  @IsString()
  @IsNotEmpty()
  @MinLength(8)
  @Matches(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&].{8,}$/, {
    message: 'Password must contain at least 8 characters, one uppercase, one lowercase, one number and one special character'
  })
  password: string;

  @IsString()
  @IsNotEmpty()
  @MinLength(2)
  firstName: string;

  @IsString()
  @IsNotEmpty()
  @MinLength(2)
  lastName: string;

  @IsOptional()
  @IsEnum(['customer', 'business'])
  accountType: 'customer' | 'business';

  @IsBoolean()
  @IsOptional()
  acceptTerms: boolean;

  @IsBoolean()
  @IsOptional()
  acceptPrivacyPolicy: boolean;
}

// Registration Service
@Injectable()
export class RegistrationService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    private passwordService: PasswordService,
    private emailService: EmailService,
    private smsService: SMSService,
  ) {}

  async register(registerDto: RegisterDto) {
    // Validate email uniqueness
    const existingEmail = await this.userRepository.findOne({
      where: { email: registerDto.email },
    });
    
    if (existingEmail) {
      throw new ConflictException('Email already exists');
    }

    // Validate phone uniqueness if provided
    if (registerDto.phoneNumber) {
      const existingPhone = await this.userRepository.findOne({
        where: { phoneNumber: registerDto.phoneNumber },
      });
      
      if (existingPhone) {
        throw new ConflictException('Phone number already exists');
      }
    }

    // Validate password strength
    const passwordValidation = this.passwordService.validatePasswordStrength(registerDto.password);
    if (!passwordValidation.isValid) {
      throw new BadRequestException(passwordValidation.errors.join(', '));
    }

    // Hash password
    const hashedPassword = await this.passwordService.hashPassword(registerDto.password);

    // Create user
    const user = this.userRepository.create({
      ...registerDto,
      password: hashedPassword,
      emailVerified: false,
      phoneVerified: !registerDto.phoneNumber, // Auto-verify if no phone
      accountStatus: 'pending_verification',
    });

    await this.userRepository.save(user);

    // Send verification emails/SMS
    await this.emailService.sendVerificationEmail(user.email);
    if (registerDto.phoneNumber) {
      await this.smsService.sendVerificationSMS(user.phoneNumber);
    }

    return {
      message: 'Registration successful. Please check your email for verification.',
      userId: user.id,
    };
  }
}
```

#### 2.2 Implement Email Verification Workflow
- Create email verification token generation
- Implement secure email sending with templates
- Add verification link expiration (24 hours)
- Create email verification status tracking
- Implement resend verification functionality

```typescript
// Email Verification Service
@Injectable()
export class EmailVerificationService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(EmailVerification) 
    private emailVerificationRepository: Repository<EmailVerification>,
    private emailService: EmailService,
  ) {}

  async generateVerificationToken(email: string): Promise<string> {
    const token = uuidv4();
    const expiresAt = new Date(Date.now() + 24 * 60 * 60 * 1000); // 24 hours
    
    await this.emailVerificationRepository.save({
      email,
      token,
      expiresAt,
      attempts: 0,
    });
    
    return token;
  }

  async verifyEmail(token: string): Promise<boolean> {
    const verification = await this.emailVerificationRepository.findOne({
      where: { token },
      relations: ['user'],
    });
    
    if (!verification || verification.expiresAt < new Date()) {
      throw new BadRequestException('Invalid or expired verification token');
    }

    if (verification.attempts >= 3) {
      throw new BadRequestException('Maximum verification attempts exceeded');
    }

    // Update verification attempts
    verification.attempts += 1;
    await this.emailVerificationRepository.save(verification);

    // Mark email as verified
    await this.userRepository.update(
      { id: verification.user.id },
      { emailVerified: true, accountStatus: 'active' }
    );

    // Clean up verification token
    await this.emailVerificationRepository.delete({ id: verification.id });

    return true;
  }

  async resendVerification(email: string): Promise<void> {
    const existingVerification = await this.emailVerificationRepository.findOne({
      where: { email },
      order: { createdAt: 'DESC' },
    });

    if (existingVerification && existingVerification.createdAt > new Date(Date.now() - 5 * 60 * 1000)) {
      throw new BadRequestException('Please wait 5 minutes before requesting another verification email');
    }

    const token = await this.generateVerificationToken(email);
    await this.emailService.sendVerificationEmail(email, token);
  }
}
```

#### 2.3 Set Up Phone Number Verification
- Implement Bangladesh phone number format validation
- Create SMS verification code generation
- Add SMS gateway integration (Teletalk, Robi)
- Implement verification code expiration (10 minutes)
- Create phone verification status tracking

```typescript
// SMS Verification Service
@Injectable()
export class SMSVerificationService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(PhoneVerification) 
    private phoneVerificationRepository: Repository<PhoneVerification>,
    private smsService: SMSService,
  ) {}

  async generateVerificationCode(phoneNumber: string): Promise<string> {
    const code = Math.floor(100000 + Math.random() * 900000).toString();
    const expiresAt = new Date(Date.now() + 10 * 60 * 1000); // 10 minutes
    
    await this.phoneVerificationRepository.save({
      phoneNumber,
      code,
      expiresAt,
      attempts: 0,
    });
    
    return code;
  }

  async verifyPhoneNumber(phoneNumber: string, code: string): Promise<boolean> {
    const verification = await this.phoneVerificationRepository.findOne({
      where: { phoneNumber, code },
      relations: ['user'],
    });
    
    if (!verification || verification.expiresAt < new Date()) {
      throw new BadRequestException('Invalid or expired verification code');
    }

    if (verification.attempts >= 3) {
      throw new BadRequestException('Maximum verification attempts exceeded');
    }

    // Update verification attempts
    verification.attempts += 1;
    await this.phoneVerificationRepository.save(verification);

    // Mark phone as verified
    await this.userRepository.update(
      { id: verification.user.id },
      { phoneVerified: true, accountStatus: 'active' }
    );

    // Clean up verification code
    await this.phoneVerificationRepository.delete({ id: verification.id });

    return true;
  }

  async sendVerificationSMS(phoneNumber: string): Promise<void> {
    const code = await this.generateVerificationCode(phoneNumber);
    
    const message = `Your Saffron verification code is: ${code}. Valid for 10 minutes.`;
    
    // Try Teletalk first, fallback to Robi
    try {
      await this.smsService.sendViaTeletalk(phoneNumber, message);
    } catch (error) {
      await this.smsService.sendViaRobi(phoneNumber, message);
    }
  }
}
```

#### 2.4 Implement Social Login Integration
- Create Google OAuth 2.0 integration
- Add Facebook Login integration
- Implement social profile mapping
- Create account linking functionality
- Add social login security measures

```typescript
// Social Login Service
@Injectable()
export class SocialLoginService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    private authService: AuthService,
  ) {}

  async authenticateGoogle(token: string): Promise<any> {
    const ticket = await this.client.verifyIdToken({
      idToken: token,
      audience: process.env.GOOGLE_CLIENT_ID,
    });
    
    const payload = ticket.getPayload();
    
    if (!payload.email) {
      throw new BadRequestException('Invalid Google token');
    }

    let user = await this.userRepository.findOne({
      where: { email: payload.email },
    });

    if (!user) {
      // Create new user from Google profile
      user = this.userRepository.create({
        email: payload.email,
        firstName: payload.given_name,
        lastName: payload.family_name,
        avatarUrl: payload.picture,
        emailVerified: true,
        accountStatus: 'active',
        authProvider: 'google',
        authProviderId: payload.sub,
      });
      
      await this.userRepository.save(user);
    }

    // Generate tokens for existing/new user
    const tokens = await this.authService.generateTokens(user);
    
    // Track social login
    await this.trackSocialLogin(user.id, 'google');

    return {
      user: {
        id: user.id,
        email: user.email,
        firstName: user.firstName,
        lastName: user.lastName,
      },
      ...tokens,
    };
  }

  async linkSocialAccount(userId: string, provider: string, providerId: string): Promise<void> {
    const existingLink = await this.userSocialAccountRepository.findOne({
      where: { userId, provider, providerId },
    });

    if (existingLink) {
      throw new ConflictException('Social account already linked');
    }

    await this.userSocialAccountRepository.save({
      userId,
      provider,
      providerId,
    });
  }
}
```

#### 2.5 Add CAPTCHA Protection
- Implement reCAPTCHA integration
- Add invisible CAPTCHA for registration
- Create CAPTCHA validation middleware
- Implement fallback for accessibility
- Add CAPTCHA analytics and monitoring

```typescript
// CAPTCHA Service
@Injectable()
export class CaptchaService {
  constructor() {}

  async validateRecaptcha(token: string): Promise<boolean> {
    const response = await axios.post(
      'https://www.google.com/recaptcha/api/siteverify',
      {
        secret: process.env.RECAPTCHA_SECRET_KEY,
        response: token,
      },
    );

    return response.data.success;
  }

  async generateCaptchaChallenge(): Promise<any> {
    // Generate invisible reCAPTCHA challenge
    return {
      siteKey: process.env.RECAPTCHA_SITE_KEY,
      theme: 'light',
    };
  }
}

// CAPTCHA Guard
@Injectable()
export class CaptchaGuard implements CanActivate {
  constructor(private captchaService: CaptchaService) {}

  async canActivate(context: ExecutionContext): Promise<boolean> {
    const request = context.switchToHttp.getRequest();
    const { captchaToken } = request.body;

    if (!captchaToken) {
      throw new BadRequestException('CAPTCHA token is required');
    }

    const isValid = await this.captchaService.validateRecaptcha(captchaToken);
    if (!isValid) {
      throw new BadRequestException('Invalid CAPTCHA token');
    }

    return true;
  }
}
```

### Acceptance Criteria for Validation
- User registration validates all required fields properly
- Email verification works with 24-hour token expiration
- Phone number verification supports Bangladesh formats (+880, 01)
- Social login integration functional with Google and Facebook
- CAPTCHA protection working with proper validation
- Registration rate limiting implemented (3 attempts per hour per IP)

### Estimated Completion Time
- **Total Duration:** 2 days
- **Registration System:** 6 hours
- **Email Verification:** 4 hours
- **Phone Verification:** 4 hours
- **Social Login:** 4 hours
- **CAPTCHA Integration:** 2 hours

### Required Resources
- Email service provider (SendGrid or local alternative)
- SMS gateway APIs (Teletalk, Robi)
- Google OAuth 2.0 credentials
- Facebook Login developer credentials
- reCAPTCHA keys

### Validation Checkpoints and Testing Procedures
- Test registration with all validation scenarios
- Verify email delivery and verification link functionality
- Test SMS delivery to Bangladesh phone numbers
- Validate social login flow with account creation
- Test CAPTCHA validation under various conditions

### Technical Specifications
- **Email Verification:** 24-hour token expiration, 3 attempt limit
- **Phone Verification:** 10-minute code expiration, 6-digit codes
- **Social Authentication:** OAuth 2.0 with secure token exchange
- **CAPTCHA Protection:** Google reCAPTCHA v2 with fallback options
- **Rate Limiting:** 3 registrations per hour per IP address

---

## MILESTONE 3: PASSWORD SECURITY IMPLEMENTATION

### Objectives and Goals
Implement comprehensive password security features including secure reset flows, strength requirements, account lockout mechanisms, password history tracking, and two-factor authentication.

### Detailed Subtasks with Implementation Steps

#### 3.1 Create Secure Password Reset Flow
- Implement password reset token generation
- Create secure reset link with expiration
- Add reset email/SMS notification
- Implement password reset validation
- Create reset confirmation and logging

```typescript
// Password Reset Service
@Injectable()
export class PasswordResetService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(PasswordReset) 
    private passwordResetRepository: Repository<PasswordReset>,
    private passwordService: PasswordService,
    private emailService: EmailService,
    private smsService: SMSService,
  ) {}

  async initiatePasswordReset(emailOrPhone: string): Promise<void> {
    const user = await this.userRepository.findOne({
      where: [
        { email: emailOrPhone },
        { phoneNumber: emailOrPhone },
      ],
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Check recent reset attempts
    const recentReset = await this.passwordResetRepository.findOne({
      where: {
        userId: user.id,
        createdAt: MoreThan(new Date(Date.now() - 15 * 60 * 1000)), // 15 minutes
      },
    });

    if (recentReset) {
      throw new BadRequestException('Password reset already requested. Please wait 15 minutes.');
    }

    // Generate reset token
    const token = uuidv4();
    const expiresAt = new Date(Date.now() + 1 * 60 * 60 * 1000); // 1 hour

    await this.passwordResetRepository.save({
      userId: user.id,
      token,
      expiresAt,
      isUsed: false,
    });

    // Send reset notification
    if (user.email) {
      await this.emailService.sendPasswordResetEmail(user.email, token);
    } else if (user.phoneNumber) {
      await this.smsService.sendPasswordResetSMS(user.phoneNumber, token);
    }
  }

  async resetPassword(token: string, newPassword: string): Promise<void> {
    const reset = await this.passwordResetRepository.findOne({
      where: { token, isUsed: false },
      relations: ['user'],
    });

    if (!reset || reset.expiresAt < new Date()) {
      throw new BadRequestException('Invalid or expired reset token');
    }

    // Validate new password strength
    const passwordValidation = this.passwordService.validatePasswordStrength(newPassword);
    if (!passwordValidation.isValid) {
      throw new BadRequestException(passwordValidation.errors.join(', '));
    }

    // Hash new password
    const hashedPassword = await this.passwordService.hashPassword(newPassword);

    // Update user password
    await this.userRepository.update(
      { id: reset.user.id },
      { password: hashedPassword }
    );

    // Mark reset token as used
    await this.passwordResetRepository.update(
      { id: reset.id },
      { isUsed: true, usedAt: new Date() }
    );

    // Log password reset
    await this.logPasswordReset(reset.user.id, 'Password reset successful');
  }
}
```

#### 3.2 Implement Password Strength Requirements
- Create comprehensive password policy validation
- Implement real-time password strength checking
- Add password strength indicators
- Create password suggestion system
- Implement culturally appropriate requirements

```typescript
// Password Strength Validator
@Injectable()
export class PasswordStrengthValidator {
  validatePasswordStrength(password: string): {
    score: number;
    feedback: string[];
    isStrong: boolean;
    suggestions: string[];
  } {
    const feedback = [];
    let score = 0;

    // Length check
    if (password.length >= 8) score += 1;
    if (password.length >= 12) score += 1;

    // Character variety checks
    if (/[a-z]/.test(password)) {
      score += 1;
    } else {
      feedback.push('Add lowercase letters');
    }

    if (/[A-Z]/.test(password)) {
      score += 1;
    } else {
      feedback.push('Add uppercase letters');
    }

    if (/[0-9]/.test(password)) {
      score += 1;
    } else {
      feedback.push('Add numbers');
    }

    if (/[!@#$%^&*()_+=\-\[\]{}|\\;:'",.<>?]/.test(password)) {
      score += 1;
    } else {
      feedback.push('Add special characters');
    }

    // Common password check
    if (this.isCommonPassword(password)) {
      score -= 2;
      feedback.push('Avoid common passwords');
    }

    // Bengali-specific considerations
    if (!/[\u0980-\u09FF]/.test(password)) {
      feedback.push('Consider using Bengali characters for stronger password');
    }

    const suggestions = this.generatePasswordSuggestions(feedback);

    return {
      score: Math.max(0, Math.min(5, score)),
      feedback,
      isStrong: score >= 4,
      suggestions,
    };
  }

  private isCommonPassword(password: string): boolean {
    const commonPasswords = [
      'password', '123456', 'password123', 'admin', 'qwerty',
      'bangladesh', 'dhaka', '12345678', 'password1',
    ];
    return commonPasswords.includes(password.toLowerCase());
  }

  private generatePasswordSuggestions(feedback: string[]): string[] {
    const suggestions = [];
    
    if (feedback.includes('Add lowercase letters')) {
      suggestions.push('Include at least one lowercase letter (a-z)');
    }
    
    if (feedback.includes('Add uppercase letters')) {
      suggestions.push('Include at least one uppercase letter (A-Z)');
    }
    
    if (feedback.includes('Add numbers')) {
      suggestions.push('Include at least one number (0-9)');
    }
    
    if (feedback.includes('Add special characters')) {
      suggestions.push('Include at least one special character (!@#$%^&*)');
    }
    
    if (feedback.includes('Consider using Bengali characters')) {
      suggestions.push('Consider using Bengali characters: অ আ ই ঈ উ ঊ ঋ ঌ এ ঐ ও ঔ ক খ গ ঘ ঙ চ ছ জ ঝ ঞ ট ঠ ড ঢ ণ ম ন');
    }
    
    return suggestions;
  }
}
```

#### 3.3 Implement Account Lockout Mechanism
- Create failed login attempt tracking
- Implement progressive lockout periods
- Add account unlock procedures
- Create lockout notification system
- Implement admin override capabilities

```typescript
// Account Lockout Service
@Injectable()
export class AccountLockoutService {
  constructor(
    @InjectRepository(LoginAttempt) 
    private loginAttemptRepository: Repository<LoginAttempt>,
    @InjectRepository(User) private userRepository: Repository<User>,
  ) {}

  async trackFailedLogin(identifier: string, ipAddress: string): Promise<void> {
    const attempts = await this.getRecentAttempts(identifier, ipAddress);
    
    // Record failed attempt
    await this.loginAttemptRepository.save({
      identifier,
      ipAddress,
      success: false,
      attemptTime: new Date(),
    });

    // Check lockout threshold
    const lockoutThresholds = [
      { attempts: 3, window: 15 * 60 * 1000 }, // 3 attempts in 15 minutes
      { attempts: 5, window: 60 * 60 * 1000 }, // 5 attempts in 1 hour
      { attempts: 10, window: 24 * 60 * 60 * 1000 }, // 10 attempts in 24 hours
    ];

    for (const threshold of lockoutThresholds) {
      if (attempts.length >= threshold.attempts) {
        const lockoutDuration = this.calculateLockoutDuration(attempts.length);
        await this.lockAccount(identifier, lockoutDuration);
        break;
      }
    }
  }

  async lockAccount(identifier: string, duration: number): Promise<void> {
    const lockoutUntil = new Date(Date.now() + duration);
    
    await this.userRepository.update(
      { email: identifier },
      { 
        accountStatus: 'locked',
        lockedUntil: lockoutUntil,
        lockoutReason: 'Too many failed login attempts'
      }
    );

    // Send lockout notification
    await this.sendLockoutNotification(identifier, lockoutUntil);
  }

  async unlockAccount(identifier: string): Promise<void> {
    await this.userRepository.update(
      { email: identifier },
      { 
        accountStatus: 'active',
        lockedUntil: null,
        lockoutReason: null
      }
    );
  }

  private calculateLockoutDuration(attempts: number): number {
    // Progressive lockout: 5min, 15min, 30min, 1hr, 2hr, 4hr, 8hr, 24hr
    const baseDuration = 5 * 60 * 1000; // 5 minutes
    return baseDuration * Math.pow(2, Math.min(attempts - 2, 8));
  }
}
```

#### 3.4 Create Password History Tracking
- Implement password history storage
- Add password reuse prevention
- Create password change logging
- Implement password rotation policies
- Add password analytics and monitoring

```typescript
// Password History Service
@Injectable()
export class PasswordHistoryService {
  constructor(
    @InjectRepository(PasswordHistory) 
    private passwordHistoryRepository: Repository<PasswordHistory>,
  ) {}

  async recordPasswordChange(userId: string, oldPasswordHash: string, newPasswordHash: string): Promise<void> {
    // Get existing password history
    const history = await this.getPasswordHistory(userId);
    
    // Check for password reuse
    const isReused = history.some(entry => 
      entry.passwordHash === oldPasswordHash || 
      entry.passwordHash === newPasswordHash
    );

    if (isReused) {
      throw new BadRequestException('Cannot reuse a previous password');
    }

    // Add new password to history
    await this.passwordHistoryRepository.save({
      userId,
      passwordHash: newPasswordHash,
      changedAt: new Date(),
    });

    // Maintain only last 12 passwords
    if (history.length >= 12) {
      const oldestPassword = history[0];
      await this.passwordHistoryRepository.delete({ id: oldestPassword.id });
    }
  }

  async getPasswordHistory(userId: string): Promise<PasswordHistory[]> {
    return this.passwordHistoryRepository.find({
      where: { userId },
      order: { changedAt: 'DESC' },
      take: 12,
    });
  }

  async checkPasswordReuse(userId: string, newPasswordHash: string): Promise<boolean> {
    const history = await this.getPasswordHistory(userId);
    return history.some(entry => entry.passwordHash === newPasswordHash);
  }
}
```

#### 3.5 Implement Two-Factor Authentication
- Create TOTP (Time-based One-Time Password) support
- Implement SMS-based 2FA backup
- Add 2FA setup and recovery flows
- Create 2FA bypass codes for emergency
- Implement 2FA analytics and monitoring

```typescript
// Two-Factor Authentication Service
@Injectable()
export class TwoFactorAuthService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(TwoFactorAuth) 
    private twoFactorAuthRepository: Repository<TwoFactorAuth>,
    private smsService: SMSService,
  ) {}

  async enable2FA(userId: string): Promise<{ secret: string; backupCodes: string[] }> {
    const secret = speakeasy.generateSecret();
    const backupCodes = Array.from({ length: 10 }, () => 
      Math.floor(100000 + Math.random() * 900000).toString()
    );

    // Save 2FA settings
    await this.twoFactorAuthRepository.save({
      userId,
      secret,
      backupCodes,
      isEnabled: true,
      method: 'totp',
    });

    return { secret, backupCodes };
  }

  async verifyTOTP(userId: string, token: string): Promise<boolean> {
    const twoFactorAuth = await this.twoFactorAuthRepository.findOne({
      where: { userId, isEnabled: true },
    });

    if (!twoFactorAuth) {
      throw new BadRequestException('2FA not enabled for this user');
    }

    const verified = speakeasy.totp.verify({
      secret: twoFactorAuth.secret,
      encoding: 'base32',
      token,
      window: 2, // 2 windows (30 seconds each)
    });

    if (verified) {
      // Mark backup code as used if it matches
      await this.markBackupCodeUsed(twoFactorAuth, token);
    }

    return verified;
  }

  async sendSMS2FA(userId: string): Promise<string> {
    const twoFactorAuth = await this.twoFactorAuthRepository.findOne({
      where: { userId, isEnabled: true },
    });

    if (!twoFactorAuth) {
      throw new BadRequestException('2FA not enabled for this user');
    }

    // Find unused backup code
    const backupCode = twoFactorAuth.backupCodes.find(code => 
      code.used === false && code.expiresAt > new Date()
    );

    if (!backupCode) {
      throw new BadRequestException('No available backup codes');
    }

    const user = await this.userRepository.findOne({ where: { id: userId } });
    
    const message = `Your Saffron 2FA code is: ${backupCode.code}`;
    await this.smsService.sendViaTeletalk(user.phoneNumber, message);

    // Mark code as sent
    backupCode.sentAt = new Date();
    await this.twoFactorAuthRepository.save(twoFactorAuth);

    return backupCode.code;
  }

  private async markBackupCodeUsed(twoFactorAuth: TwoFactorAuth, code: string): Promise<void> {
    const backupCode = twoFactorAuth.backupCodes.find(bc => bc.code === code);
    if (backupCode) {
      backupCode.used = true;
      backupCode.usedAt = new Date();
      await this.twoFactorAuthRepository.save(twoFactorAuth);
    }
  }
}
```

### Acceptance Criteria for Validation
- Password reset flow working with secure token generation and 1-hour expiration
- Password strength requirements enforced with minimum score of 4/5
- Account lockout implemented with progressive durations (5min to 24hr)
- Password history tracking prevents reuse of last 12 passwords
- Two-factor authentication working with TOTP and SMS backup
- All password operations properly logged and audited

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Password Reset:** 4 hours
- **Password Strength:** 3 hours
- **Account Lockout:** 3 hours
- **Password History:** 2 hours
- **Two-Factor Auth:** 2 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Email service for password reset notifications
- SMS service for 2FA backup codes
- TOTP library (speakeasy or equivalent)
- Password strength validation library
- Account lockout tracking database

### Validation Checkpoints and Testing Procedures
- Test password reset with expired and invalid tokens
- Verify password strength validation with various inputs
- Test account lockout with different attempt scenarios
- Validate password history prevents reuse
- Test 2FA with TOTP apps and SMS backup

### Technical Specifications
- **Reset Tokens:** UUID with 1-hour expiration, single-use
- **Password Strength:** Minimum 8 characters, 4/5 score requirement
- **Lockout Policy:** Progressive from 5 minutes to 24 hours based on attempts
- **Password History:** Track last 12 passwords, prevent reuse
- **2FA Methods:** TOTP with 6-digit codes, SMS backup with 10 codes

---

## MILESTONE 4: ROLE-BASED ACCESS CONTROL (RBAC)

### Objectives and Goals
Implement a comprehensive role-based access control system with hierarchical permissions, resource-based access control, API endpoint protection, admin panel access levels, and permission management interface.

### Detailed Subtasks with Implementation Steps

#### 4.1 Design Role Hierarchy and Permissions
- Create hierarchical role structure
- Implement resource-based permission system
- Add role inheritance mechanisms
- Create permission categorization
- Implement dynamic permission assignment

```typescript
// Role and Permission Entities
@Entity()
export class Role {
  @PrimaryGeneratedColumn('uuid')
  id: string;

  @Column({ unique: true })
  name: string;

  @Column({ type: 'text', nullable: true })
  description: string;

  @Column({ nullable: true })
  parentRoleId: string;

  @ManyToOne(() => Role, { nullable: true })
  @JoinColumn({ name: 'parentRole' })
  parentRole: Role;

  @Column({ default: 0 })
  level: number;

  @CreateDateColumn()
  createdAt: Date;

  @UpdateDateColumn()
  updatedAt: Date;

  @ManyToMany(() => Permission, { cascade: true })
  @JoinTable({
    name: 'role_permissions',
    joinColumn: { name: 'roleId', referencedColumnName: 'id' },
    inverseJoinColumn: { name: 'permissionId', referencedColumnName: 'id' },
  })
  permissions: Permission[];
}

@Entity()
export class Permission {
  @PrimaryGeneratedColumn('uuid')
  id: string;

  @Column({ unique: true })
  name: string;

  @Column()
  resource: string;

  @Column()
  action: string;

  @Column({ type: 'text', nullable: true })
  description: string;

  @Column({ default: true })
  isActive: boolean;

  @CreateDateColumn()
  createdAt: Date;

  @ManyToMany(() => Role, { cascade: true })
  @JoinTable({
    name: 'role_permissions',
    joinColumn: { name: 'permissionId', referencedColumnName: 'id' },
    inverseJoinColumn: { name: 'roleId', referencedColumnName: 'id' },
  })
  roles: Role[];
}

// Role Service
@Injectable()
export class RoleService {
  constructor(
    @InjectRepository(Role) private roleRepository: Repository<Role>,
    @InjectRepository(Permission) 
    private permissionRepository: Repository<Permission>,
  ) {}

  async createRole(createRoleDto: CreateRoleDto): Promise<Role> {
    // Calculate role level based on hierarchy
    let level = 0;
    if (createRoleDto.parentRoleId) {
      const parentRole = await this.roleRepository.findOne({
        where: { id: createRoleDto.parentRoleId },
      });
      level = (parentRole?.level || 0) + 1;
    }

    const role = this.roleRepository.create({
      ...createRoleDto,
      level,
    });

    return this.roleRepository.save(role);
  }

  async assignPermissionToRole(roleId: string, permissionId: string): Promise<void> {
    const role = await this.roleRepository.findOne({
      where: { id: roleId },
      relations: ['permissions'],
    });

    if (!role) {
      throw new NotFoundException('Role not found');
    }

    const permission = await this.permissionRepository.findOne({
      where: { id: permissionId },
    });

    if (!permission) {
      throw new NotFoundException('Permission not found');
    }

    role.permissions.push(permission);
    await this.roleRepository.save(role);
  }

  async getRoleHierarchy(): Promise<Role[]> {
    return this.roleRepository.find({
      order: { level: 'ASC' },
    });
  }
}
```

#### 4.2 Implement Resource-Based Access Control
- Create resource categorization system
- Implement action-based permissions
- Add resource ownership validation
- Create permission inheritance rules
- Implement dynamic permission checking

```typescript
// Permission Service
@Injectable()
export class PermissionService {
  constructor(
    @InjectRepository(Permission) 
    private permissionRepository: Repository<Permission>,
    @InjectRepository(UserRole) 
    private userRoleRepository: Repository<UserRole>,
  ) {}

  async checkPermission(
    userId: string, 
    resource: string, 
    action: string, 
    resourceId?: string
  ): Promise<boolean> {
    // Get user roles with permissions
    const userRoles = await this.userRoleRepository.find({
      where: { userId },
      relations: ['role', 'role.permissions'],
    });

    // Check permission hierarchy
    for (const userRole of userRoles) {
      const role = userRole.role;
      
      // Check direct permissions
      const hasDirectPermission = role.permissions.some(permission =>
        permission.resource === resource && 
        permission.action === action &&
        permission.isActive
      );

      if (hasDirectPermission) {
        return true;
      }

      // Check inherited permissions from parent roles
      const hasInheritedPermission = await this.checkInheritedPermission(
        role.parentRole, 
        resource, 
        action
      );

      if (hasInheritedPermission) {
        return true;
      }
    }

    return false;
  }

  private async checkInheritedPermission(
    role: Role, 
    resource: string, 
    action: string
  ): Promise<boolean> {
    if (!role) return false;

    // Get parent role with permissions
    const parentRole = await this.roleRepository.findOne({
      where: { id: role.parentRoleId },
      relations: ['permissions'],
    });

    if (!parentRole) return false;

    // Check parent permissions
    return parentRole.permissions.some(permission =>
      permission.resource === resource && 
      permission.action === action &&
      permission.isActive
    );
  }

  async createResourcePermission(
    resource: string, 
    actions: string[], 
    description?: string
  ): Promise<Permission[]> {
    const permissions = actions.map(action => 
      this.permissionRepository.create({
        name: `${resource}_${action}`,
        resource,
        action,
        description: `${description} - ${action} permission for ${resource}`,
      })
    );

    return this.permissionRepository.save(permissions);
  }
}
```

#### 4.3 Create API Endpoint Protection
- Implement permission-based guards
- Create resource access decorators
- Add automatic permission checking
- Implement role-based middleware
- Create permission caching mechanisms

```typescript
// Permissions Guard
@Injectable()
export class PermissionsGuard implements CanActivate {
  constructor(
    private reflector: Reflector,
    private permissionService: PermissionService,
  ) {}

  async canActivate(context: ExecutionContext): Promise<boolean> {
    const requiredPermissions = this.reflector.get<string[]>(
      'permissions',
      context.getHandler(),
    );

    if (!requiredPermissions) {
      return true;
    }

    const { user } = context.switchToHttp().getRequest();
    
    if (!user) {
      throw new UnauthorizedException('User not authenticated');
    }

    // Check each required permission
    for (const permission of requiredPermissions) {
      const [resource, action] = permission.split(':');
      const hasPermission = await this.permissionService.checkPermission(
        user.id,
        resource,
        action
      );

      if (!hasPermission) {
        throw new ForbiddenException(
          `Insufficient permissions: ${permission} required`
        );
      }
    }

    return true;
  }
}

// Permissions Decorator
export const RequirePermissions = (...permissions: string[]) =>
  SetMetadata('permissions', permissions);

// Usage on controller
@Get('products')
@RequirePermissions('product:read', 'product:create')
@UseGuards(JwtAuthGuard, PermissionsGuard)
async getProducts() {
  // This endpoint requires both product:read and product:create permissions
  return { message: 'Access granted' };
}
```

#### 4.4 Build Admin Panel Access Levels
- Create admin role hierarchy
- Implement admin-specific permissions
- Add admin access logging
- Create admin session management
- Implement admin approval workflows

```typescript
// Admin Role Definitions
export const ADMIN_ROLES = {
  SUPER_ADMIN: 'super_admin',
  ADMIN: 'admin',
  MODERATOR: 'moderator',
  SUPPORT: 'support',
  ANALYST: 'analyst',
} as const;

export const ADMIN_PERMISSIONS = {
  // User Management
  'user:create': 'Create new users',
  'user:read': 'View user information',
  'user:update': 'Update user details',
  'user:delete': 'Delete users',
  
  // Product Management
  'product:create': 'Create new products',
  'product:read': 'View product information',
  'product:update': 'Update product details',
  'product:delete': 'Delete products',
  
  // Order Management
  'order:read': 'View order information',
  'order:update': 'Update order status',
  'order:cancel': 'Cancel orders',
  
  // System Administration
  'system:config': 'Modify system configuration',
  'system:logs': 'View system logs',
  'system:backup': 'Perform system backups',
} as const;

// Admin Access Service
@Injectable()
export class AdminAccessService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(AdminLog) 
    private adminLogRepository: Repository<AdminLog>,
  ) {}

  async grantAdminAccess(
    userId: string, 
    adminRole: keyof typeof ADMIN_ROLES,
    grantedBy: string
  ): Promise<void> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Update user role
    await this.userRepository.update(
      { id: userId },
      { role: adminRole }
    );

    // Log admin access grant
    await this.adminLogRepository.save({
      userId,
      action: 'admin_access_granted',
      details: `Granted ${adminRole} role`,
      performedBy: grantedBy,
      ipAddress: 'admin_panel',
      timestamp: new Date(),
    });
  }

  async checkAdminAccess(
    userId: string, 
    requiredRole: keyof typeof ADMIN_ROLES
  ): Promise<boolean> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      return false;
    }

    const roleHierarchy = {
      [ADMIN_ROLES.SUPER_ADMIN]: 5,
      [ADMIN_ROLES.ADMIN]: 4,
      [ADMIN_ROLES.MODERATOR]: 3,
      [ADMIN_ROLES.SUPPORT]: 2,
      [ADMIN_ROLES.ANALYST]: 1,
    };

    return roleHierarchy[user.role] >= roleHierarchy[requiredRole];
  }
}
```

#### 4.5 Implement Permission Management Interface
- Create permission CRUD operations
- Implement role assignment interface
- Add permission management UI
- Create permission audit trail
- Implement permission validation rules

```typescript
// Permission Management Controller
@Controller('admin/permissions')
@UseGuards(JwtAuthGuard, AdminGuard)
export class PermissionManagementController {
  constructor(
    private permissionService: PermissionService,
    private roleService: RoleService,
  ) {}

  @Post('roles')
  async createRole(@Body() createRoleDto: CreateRoleDto): Promise<Role> {
    return this.roleService.createRole(createRoleDto);
  }

  @Get('roles')
  async getRoles(): Promise<Role[]> {
    return this.roleService.getRoleHierarchy();
  }

  @Post('permissions')
  async createPermission(@Body() createPermissionDto: CreatePermissionDto): Promise<Permission[]> {
    return this.permissionService.createResourcePermission(
      createPermissionDto.resource,
      createPermissionDto.actions,
      createPermissionDto.description
    );
  }

  @Post('assign')
  async assignPermission(@Body() assignPermissionDto: AssignPermissionDto): Promise<void> {
    await this.permissionService.assignPermissionToRole(
      assignPermissionDto.roleId,
      assignPermissionDto.permissionId
    );
  }

  @Get('audit')
  async getPermissionAudit(@Query() userId?: string): Promise<PermissionAudit[]> {
    return this.permissionService.getPermissionAudit(userId);
  }
}
```

### Acceptance Criteria for Validation
- Role hierarchy properly implemented with inheritance mechanisms
- Resource-based permissions working with fine-grained access control
- API endpoint protection functioning with permission guards
- Admin access levels implemented with proper hierarchy
- Permission management interface providing CRUD operations
- Permission caching working for improved performance

### Estimated Completion Time
- **Total Duration:** 2 days
- **Role Hierarchy:** 5 hours
- **Resource-Based Access Control:** 5 hours
- **API Endpoint Protection:** 4 hours
- **Admin Access Levels:** 3 hours
- **Permission Management Interface:** 3 hours

### Required Resources
- Role and permission database entities
- Permission checking middleware
- Admin panel UI components
- Permission audit logging system
- Permission caching mechanism

### Validation Checkpoints and Testing Procedures
- Test role inheritance with multiple hierarchy levels
- Verify resource-based permissions with various scenarios
- Test API endpoint protection with different user roles
- Validate admin access levels with proper authorization
- Test permission management interface functionality

### Technical Specifications
- **Role Hierarchy:** Maximum 5 levels with parent-child relationships
- **Permission Format:** resource:action format (e.g., user:create, product:read)
- **Permission Caching:** Redis-based with 1-hour expiration
- **Admin Roles:** 5 distinct levels from Analyst to Super Admin
- **Permission Audit:** Complete audit trail with user, action, timestamp

---

## MILESTONE 5: API SECURITY IMPLEMENTATION

### Objectives and Goals
Implement comprehensive API security measures including rate limiting, CORS configuration, input validation and sanitization, SQL injection prevention, and XSS protection.

### Detailed Subtasks with Implementation Steps

#### 5.1 Set Up Request Rate Limiting
- Implement configurable rate limiting
- Create different limits for different endpoints
- Add IP-based and user-based limiting
- Implement progressive penalty system
- Create rate limiting analytics

```typescript
// Rate Limiting Middleware
@Injectable()
export class RateLimitingService {
  constructor(
    @InjectRedis() private readonly redis: Redis,
  ) {}

  // Rate limit configuration
  private readonly rateLimits = {
    'auth/login': { windowMs: 15 * 60 * 1000, max: 5 }, // 5 attempts per 15 minutes
    'auth/register': { windowMs: 60 * 60 * 1000, max: 3 }, // 3 attempts per hour
    'password/reset': { windowMs: 15 * 60 * 1000, max: 3 }, // 3 attempts per 15 minutes
    'api/general': { windowMs: 60 * 1000, max: 100 }, // 100 requests per minute
    'api/search': { windowMs: 60 * 1000, max: 30 }, // 30 requests per minute
    'api/upload': { windowMs: 60 * 1000, max: 10 }, // 10 uploads per minute
  };

  async isRateLimitExceeded(
    key: string, 
    identifier: string, 
    options?: { skipSuccessfulRequests?: boolean }
  ): Promise<{ exceeded: boolean; remaining?: number }> {
    const limit = this.rateLimits[key];
    const windowMs = limit.windowMs;
    const max = limit.max;

    // Get current count
    const current = await this.redis.get(`rate_limit:${key}:${identifier}`);
    const count = current ? parseInt(current) : 0;

    // Check if limit exceeded
    if (count >= max) {
      return { exceeded: true, remaining: 0 };
    }

    // Increment counter
    const newCount = await this.redis.incr(`rate_limit:${key}:${identifier}`);
    
    // Set expiration for counter
    if (count === 0) {
      await this.redis.expire(`rate_limit:${key}:${identifier}`, windowMs / 1000);
    }

    const remaining = Math.max(0, max - newCount);
    return { exceeded: false, remaining };
  }

  async applyPenalty(identifier: string, key: string, penaltyMinutes: number): Promise<void> {
    const penaltyKey = `penalty:${key}:${identifier}`;
    await this.redis.setex(penaltyKey, penaltyMinutes * 60, '1');
  }

  async hasPenalty(identifier: string, key: string): Promise<boolean> {
    const penaltyKey = `penalty:${key}:${identifier}`;
    const penalty = await this.redis.get(penaltyKey);
    return penalty === '1';
  }
}

// Rate Limiting Guard
@Injectable()
export class RateLimitGuard implements CanActivate {
  constructor(
    private rateLimitingService: RateLimitingService,
  ) {}

  async canActivate(context: ExecutionContext): Promise<boolean> {
    const request = context.switchToHttp().getRequest();
    const response = response.getResponse();
    const ip = request.ip;
    const user = request.user;

    // Determine identifier (IP or user)
    const identifier = user ? `user:${user.id}` : `ip:${ip}`;
    
    // Get rate limit key from decorator
    const rateLimitKey = this.reflector.get<string>('rateLimit', context.getHandler());
    
    // Check for penalty
    const hasPenalty = await this.rateLimitingService.hasPenalty(identifier, rateLimitKey);
    if (hasPenalty) {
      throw new TooManyRequestsException('Rate limit penalty active. Please try again later.');
    }

    const { exceeded, remaining } = await this.rateLimitingService.isRateLimitExceeded(
      rateLimitKey,
      identifier
    );

    if (exceeded) {
      response.setHeader('X-RateLimit-Limit', this.rateLimitingService.getLimit(rateLimitKey).max.toString());
      response.setHeader('X-RateLimit-Remaining', '0');
      response.setHeader('X-RateLimit-Reset', new Date(Date.now() + this.rateLimitingService.getWindow(rateLimitKey)).toISOString());
      
      throw new TooManyRequestsException('Rate limit exceeded');
    }

    response.setHeader('X-RateLimit-Limit', this.rateLimitingService.getLimit(rateLimitKey).max.toString());
    response.setHeader('X-RateLimit-Remaining', remaining.toString());
    response.setHeader('X-RateLimit-Reset', new Date(Date.now() + this.rateLimitingService.getWindow(rateLimitKey)).toISOString());

    return true;
  }
}

// Rate Limit Decorator
export const RateLimit = (key?: string) =>
  SetMetadata('rateLimit', key || 'api/general');
```

#### 5.2 Implement CORS Configuration
- Configure CORS for frontend domains
- Implement pre-flight request handling
- Add CORS security headers
- Create environment-specific CORS settings
- Implement CORS caching optimization

```typescript
// CORS Configuration
export const corsConfig = {
  development: {
    origin: ['http://localhost:3000', 'http://localhost:3001'],
    credentials: true,
    methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    allowedHeaders: [
      'Origin',
      'X-Requested-With',
      'Content-Type',
      'Accept',
      'Authorization',
    ],
    maxAge: 86400, // 24 hours
  },
  production: {
    origin: ['https://saffron.com.bd', 'https://www.saffron.com.bd'],
    credentials: true,
    methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    allowedHeaders: [
      'Origin',
      'X-Requested-With',
      'Content-Type',
      'Accept',
      'Authorization',
    ],
    maxAge: 86400,
  },
  bangladeshMobile: {
    origin: ['https://m.saffron.com.bd'],
    credentials: true,
    methods: ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    allowedHeaders: [
      'Origin',
      'X-Requested-With',
      'Content-Type',
      'Accept',
      'Authorization',
    ],
    maxAge: 86400,
  },
};

// CORS Middleware Configuration
export const configureCors = (app: any) => {
  const env = process.env.NODE_ENV || 'development';
  
  app.use(cors({
    ...corsConfig[env],
    preflightContinue: false,
    optionsSuccessStatus: 204,
  }));
};
```

#### 5.3 Create Input Validation and Sanitization
- Implement comprehensive input validation
- Add data sanitization mechanisms
- Create validation error handling
- Implement custom validation rules
- Add validation logging and monitoring

```typescript
// Input Validation Service
@Injectable()
export class InputValidationService {
  constructor() {}

  validateEmail(email: string): { isValid: boolean; error?: string } {
    const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
    
    if (!emailRegex.test(email)) {
      return { isValid: false, error: 'Invalid email format' };
    }
    
    return { isValid: true };
  }

  validateBangladeshPhoneNumber(phone: string): { isValid: boolean; error?: string } {
    // Bangladesh phone number formats: +8801XXXXXXXXX or 01XXXXXXXXX
    const phoneRegex = /^(\+880|01)[0-9]{9}$/;
    
    if (!phoneRegex.test(phone)) {
      return { isValid: false, error: 'Invalid Bangladesh phone number format' };
    }
    
    return { isValid: true };
  }

  sanitizeInput(input: string): string {
    if (!input) return '';
    
    // Remove potentially dangerous characters
    return input
      .replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*<\/script>/gi, '')
      .replace(/javascript:/gi, '')
      .replace(/on\w+\s*=/gi, '')
      .trim();
  }

  validateProductInput(input: any): { isValid: boolean; errors: string[] } {
    const errors = [];
    
    // Validate product name
    if (!input.name || input.name.length < 2) {
      errors.push('Product name is required and must be at least 2 characters');
    }
    
    // Validate price
    if (!input.price || input.price <= 0) {
      errors.push('Price must be greater than 0');
    }
    
    // Validate description for XSS
    if (input.description && /<script\b[^<]*(?:(?!<\/script>)<[^<]*<\/script>/gi.test(input.description)) {
      errors.push('Description contains potentially dangerous content');
    }
    
    return {
      isValid: errors.length === 0,
      errors,
    };
  }
}

// Validation Pipe
@Injectable()
export class ValidationPipe implements PipeTransform {
  constructor(private inputValidationService: InputValidationService) {}

  async transform(value: any, { metatype }: ArgumentMetadata) {
    if (!value) {
      return value;
    }

    // Get validation rules from metadata
    const validationRules = this.getValidationRules(metatype);
    
    // Validate based on rules
    const validationResult = this.validateByRules(value, validationRules);
    
    if (!validationResult.isValid) {
      throw new BadRequestException(validationResult.errors.join(', '));
    }
    
    return validationResult.sanitizedValue;
  }

  private getValidationRules(metatype: any): any {
    // Custom validation rules based on entity type
    const rules = {
      User: {
        email: this.inputValidationService.validateEmail,
        phoneNumber: this.inputValidationService.validateBangladeshPhoneNumber,
      },
      Product: {
        general: this.inputValidationService.validateProductInput,
      },
      // Add more entity rules as needed
    };
    
    return rules[metatype] || {};
  }
}
```

#### 5.4 Implement SQL Injection Prevention
- Use parameterized queries
- Implement query builder protection
- Add ORM-level security measures
- Create query logging and monitoring
- Implement database user privilege restrictions

```typescript
// SQL Injection Prevention Service
@Injectable()
export class SQLInjectionPreventionService {
  constructor() {}

  sanitizeQuery(query: string): string {
    // Remove potentially dangerous SQL patterns
    return query
      .replace(/(\b(SELECT|INSERT|UPDATE|DELETE|DROP|CREATE|ALTER|EXEC|UNION|SCRIPT)\b/gi, '')
      .replace(/(--|;|\/\*|\*|'|"/g, '')
      .trim();
  }

  validateQueryParams(params: any): boolean {
    // Check for dangerous patterns in parameters
    const dangerousPatterns = [
      /(\b(SELECT|INSERT|UPDATE|DELETE|DROP|CREATE|ALTER|EXEC|UNION|SCRIPT)\b)/gi,
      /(--|;|\/\*|\*|'|")/g,
    ];

    for (const [key, value] of Object.entries(params)) {
      if (typeof value === 'string') {
        for (const pattern of dangerousPatterns) {
          if (pattern.test(value)) {
            return false;
          }
        }
      }
    }

    return true;
  }
}

// Secure Query Builder
@Injectable()
export class SecureQueryBuilder {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
  ) {}

  async findUsersSecurely(criteria: any): Promise<User[]> {
    // Use TypeORM query builder for parameterized queries
    return this.userRepository
      .createQueryBuilder('user')
      .where('user.email = :email', { email: criteria.email })
      .andWhere('user.status = :status', { status: criteria.status })
      .orderBy('user.createdAt', 'DESC')
      .limit(criteria.limit || 10)
      .getMany();
  }

  async createUserSecurely(userData: CreateUserDto): Promise<User> {
    // Use repository save method which handles parameterization
    const user = this.userRepository.create(userData);
    return this.userRepository.save(user);
  }
}
```

#### 5.5 Add XSS Protection
- Implement content security policy
- Add output encoding mechanisms
- Create XSS detection and prevention
- Implement secure cookie handling
- Add CSP header configuration

```typescript
// XSS Protection Service
@Injectable()
export class XSSProtectionService {
  constructor() {}

  sanitizeHtml(input: string): string {
    if (!input) return '';
    
    // Basic XSS protection
    return input
      .replace(/&/g, '&')
      .replace(/</g, '<')
      .replace(/>/g, '>')
      .replace(/"/g, '"')
      .replace(/'/g, '&#x27;');
  }

  sanitizeForAttribute(input: string): string {
    if (!input) return '';
    
    // More strict sanitization for attributes
    return input
      .replace(/&/g, '&')
      .replace(/</g, '<')
      .replace(/>/g, '>')
      .replace(/"/g, '"')
      .replace(/'/g, '&#x27;')
      .replace(/javascript:/gi, '')
      .trim();
  }

  validateInput(input: string): { isSafe: boolean; threats: string[] } {
    const threats = [];
    
    // Check for common XSS patterns
    const xssPatterns = [
      /<script\b[^<]*(?:(?!<\/script>)<[^<]*<\/script>/gi,
      /javascript:/gi,
      /on\w+\s*=/gi,
      /<iframe\b[^>]*>/gi,
    ];

    for (const pattern of xssPatterns) {
      if (pattern.test(input)) {
        threats.push(`XSS pattern detected: ${pattern}`);
      }
    }

    return {
      isSafe: threats.length === 0,
      threats,
    };
  }
}

// CSP Middleware
export const cspMiddleware = (req: any, res: any, next: any) => {
  const contentSecurityPolicy = [
    "default-src 'self'",
    "script-src 'self' 'https://www.google.com' 'https://www.gstatic.com'",
    "style-src 'self' 'unsafe-inline'",
    "img-src 'self' data: https:",
    "font-src 'self' https:",
    "connect-src 'self'",
    "frame-ancestors 'none'",
    "base-uri 'self'",
  ].join('; ');

  res.setHeader('Content-Security-Policy', contentSecurityPolicy);
  res.setHeader('X-Content-Type-Options', 'nosniff');
  res.setHeader('X-Frame-Options', 'DENY');
  res.setHeader('X-XSS-Protection', '1; mode=block');
  
  next();
};
```

### Acceptance Criteria for Validation
- Rate limiting implemented with different limits for various endpoints
- CORS properly configured for development and production environments
- Input validation working with comprehensive sanitization
- SQL injection prevention implemented with parameterized queries
- XSS protection active with CSP headers and output encoding
- All security measures logged and monitored for suspicious activities

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Rate Limiting:** 4 hours
- **CORS Configuration:** 2 hours
- **Input Validation:** 3 hours
- **SQL Injection Prevention:** 2 hours
- **XSS Protection:** 2 hours
- **Testing and Validation:** 1 hour

### Required Resources
- Rate limiting library (express-rate-limit or similar)
- Input validation library (joi or class-validator)
- Security scanning tools
- CSP configuration tools
- SQL injection testing tools

### Validation Checkpoints and Testing Procedures
- Test rate limiting with various request patterns
- Verify CORS configuration with different origins
- Test input validation with malicious payloads
- Test SQL injection prevention with attack vectors
- Validate XSS protection with various attack scenarios

### Technical Specifications
- **Rate Limiting:** Redis-based with configurable windows and limits
- **CORS:** Environment-specific with proper headers and preflight handling
- **Input Validation:** Comprehensive sanitization with custom rules for Bangladesh
- **SQL Prevention:** Parameterized queries with ORM-level protection
- **XSS Protection:** CSP headers with output encoding and secure cookies

---

## MILESTONE 6: USER PROFILE MANAGEMENT

### Objectives and Goals
Create a comprehensive user profile management system with secure data handling, avatar upload and management, preference management, address book management, and account deletion process.

### Detailed Subtasks with Implementation Steps

#### 6.1 Create Profile Editing Functionality
- Implement secure profile update endpoints
- Add profile data validation
- Create profile change tracking
- Implement profile visibility controls
- Add profile completion tracking

```typescript
// Profile Management Service
@Injectable()
export class ProfileService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(UserProfile) 
    private userProfileRepository: Repository<UserProfile>,
    private fileService: FileService,
  ) {}

  async updateProfile(
    userId: string, 
    updateProfileDto: UpdateProfileDto
  ): Promise<UserProfile> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Validate profile data
    const validation = this.validateProfileData(updateProfileDto);
    if (!validation.isValid) {
      throw new BadRequestException(validation.errors.join(', '));
    }

    // Check if profile exists
    let profile = await this.userProfileRepository.findOne({
      where: { userId },
    });

    if (!profile) {
      profile = this.userProfileRepository.create({ userId });
    }

    // Update profile with audit trail
    const oldProfile = { ...profile };
    Object.assign(profile, updateProfileDto);
    profile.updatedAt = new Date();
    profile.updatedBy = userId;

    await this.userProfileRepository.save(profile);

    // Log profile changes
    await this.logProfileChange(userId, oldProfile, profile);

    return profile;
  }

  private validateProfileData(data: UpdateProfileDto): { isValid: boolean; errors: string[] } {
    const errors = [];

    // Validate name fields
    if (data.firstName && data.firstName.length < 2) {
      errors.push('First name must be at least 2 characters');
    }

    if (data.lastName && data.lastName.length < 2) {
      errors.push('Last name must be at least 2 characters');
    }

    // Validate phone number format
    if (data.phoneNumber && !this.validateBangladeshPhoneNumber(data.phoneNumber)) {
      errors.push('Invalid Bangladesh phone number format');
    }

    // Validate date of birth
    if (data.dateOfBirth && new Date(data.dateOfBirth) > new Date()) {
      errors.push('Date of birth cannot be in the future');
    }

    return {
      isValid: errors.length === 0,
      errors,
    };
  }

  private validateBangladeshPhoneNumber(phone: string): boolean {
    const phoneRegex = /^(\+880|01)[0-9]{9}$/;
    return phoneRegex.test(phone);
  }
}
```

#### 6.2 Implement Avatar Upload and Management
- Create secure file upload system
- Implement image processing and optimization
- Add avatar validation and filtering
- Create avatar storage and CDN integration
- Implement avatar versioning and rollback

```typescript
// Avatar Management Service
@Injectable()
export class AvatarService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(Avatar) 
    private avatarRepository: Repository<Avatar>,
    private fileService: FileService,
  ) {}

  async uploadAvatar(
    userId: string, 
    file: Express.Multer.File
  ): Promise<Avatar> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Validate file
    this.validateAvatarFile(file);

    // Process image
    const processedImage = await this.fileService.processImage(file, {
      width: 200,
      height: 200,
      quality: 80,
      format: 'jpeg',
    });

    // Save to storage
    const avatarUrl = await this.fileService.saveToStorage(processedImage, 'avatars');
    
    // Create avatar record
    const avatar = this.avatarRepository.create({
      userId,
      url: avatarUrl,
      originalName: file.originalname,
      fileSize: file.size,
      mimeType: file.mimetype,
      isActive: true,
    });

    await this.avatarRepository.save(avatar);

    // Update user with new avatar
    await this.userRepository.update(
      { id: userId },
      { currentAvatarId: avatar.id }
    );

    return avatar;
  }

  private validateAvatarFile(file: Express.Multer.File): void {
    // Check file size (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
      throw new BadRequestException('Avatar file size must be less than 5MB');
    }

    // Check file type
    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    if (!allowedTypes.includes(file.mimetype)) {
      throw new BadRequestException('Only JPEG, PNG, and WebP images are allowed');
    }

    // Check image dimensions
    // This would be checked during processing
  }

  async getAvatarHistory(userId: string): Promise<Avatar[]> {
    return this.avatarRepository.find({
      where: { userId },
      order: { createdAt: 'DESC' },
      take: 10,
    });
  }

  async deleteAvatar(userId: string, avatarId: string): Promise<void> {
    const avatar = await this.avatarRepository.findOne({
      where: { id: avatarId, userId },
    });

    if (!avatar) {
      throw new NotFoundException('Avatar not found');
    }

    // Soft delete avatar
    await this.avatarRepository.update(
      { id: avatarId },
      { isActive: false, deletedAt: new Date() }
    );

    // Update user's current avatar if this was the active one
    await this.userRepository
      .createQueryBuilder()
      .update()
      .set({ currentAvatarId: null })
      .where('id = :userId AND currentAvatarId = :avatarId', { userId, avatarId })
      .execute();
  }
}
```

#### 6.3 Set Up Preference Management
- Create user preference categories
- Implement preference validation
- Add preference inheritance
- Create preference templates
- Implement preference analytics

```typescript
// User Preferences Service
@Injectable()
export class UserPreferencesService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(UserPreference) 
    private userPreferenceRepository: Repository<UserPreference>,
  ) {}

  async updatePreferences(
    userId: string, 
    preferences: UpdatePreferencesDto
  ): Promise<UserPreference[]> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    const updatedPreferences = [];

    for (const [category, value] of Object.entries(preferences)) {
      // Validate preference value
      const validation = this.validatePreferenceValue(category, value);
      if (!validation.isValid) {
        throw new BadRequestException(`Invalid ${category} preference: ${validation.error}`);
      }

      // Find existing preference
      let preference = await this.userPreferenceRepository.findOne({
        where: { userId, category },
      });

      if (!preference) {
        preference = this.userPreferenceRepository.create({
          userId,
          category,
          value,
        });
      } else {
        preference.value = value;
        preference.updatedAt = new Date();
      }

      await this.userPreferenceRepository.save(preference);
      updatedPreferences.push(preference);
    }

    return updatedPreferences;
  }

  private validatePreferenceValue(category: string, value: any): { isValid: boolean; error?: string } {
    switch (category) {
      case 'language':
        const validLanguages = ['en', 'bn'];
        if (!validLanguages.includes(value)) {
          return { isValid: false, error: 'Invalid language preference' };
        }
        break;

      case 'currency':
        const validCurrencies = ['BDT', 'USD', 'EUR'];
        if (!validCurrencies.includes(value)) {
          return { isValid: false, error: 'Invalid currency preference' };
        }
        break;

      case 'timezone':
        // Validate timezone format
        try {
          Intl.DateTimeFormat().resolvedOptions({ timeZone: value });
        } catch (error) {
          return { isValid: false, error: 'Invalid timezone preference' };
        }
        break;

      case 'notifications':
        const validNotificationTypes = ['email', 'sms', 'push', 'in_app'];
        if (!Array.isArray(value) || !value.every(type => validNotificationTypes.includes(type))) {
          return { isValid: false, error: 'Invalid notification preferences' };
        }
        break;

      default:
        return { isValid: true };
    }

    return { isValid: true };
  }

  async getPreferences(userId: string): Promise<UserPreference[]> {
    return this.userPreferenceRepository.find({
      where: { userId },
      order: { category: 'ASC' },
    });
  }
}
```

#### 6.4 Create Address Book Management
- Implement address CRUD operations
- Add Bangladesh-specific address validation
- Create address geocoding
- Implement address type classification
- Add default address selection

```typescript
// Address Management Service
@Injectable()
export class AddressService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(Address) 
    private addressRepository: Repository<Address>,
  ) {}

  async createAddress(
    userId: string, 
    createAddressDto: CreateAddressDto
  ): Promise<Address> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Validate address data
    const validation = this.validateAddressData(createAddressDto);
    if (!validation.isValid) {
      throw new BadRequestException(validation.errors.join(', '));
    }

    // Geocode address for coordinates
    const coordinates = await this.geocodeAddress(createAddressDto);

    const address = this.addressRepository.create({
      ...createAddressDto,
      userId,
      latitude: coordinates.latitude,
      longitude: coordinates.longitude,
      isDefault: false,
    });

    await this.addressRepository.save(address);

    return address;
  }

  private validateAddressData(data: CreateAddressDto): { isValid: boolean; errors: string[] } {
    const errors = [];

    // Validate required fields
    if (!data.addressLine1 || data.addressLine1.trim().length < 5) {
      errors.push('Address line 1 is required and must be at least 5 characters');
    }

    if (!data.city || data.city.trim().length < 2) {
      errors.push('City is required and must be at least 2 characters');
    }

    if (!data.district || data.district.trim().length < 2) {
      errors.push('District is required and must be at least 2 characters');
    }

    // Validate Bangladesh postal code
    if (data.postalCode && !/^[0-9]{4}$/.test(data.postalCode)) {
      errors.push('Invalid Bangladesh postal code format');
    }

    // Validate phone number if provided
    if (data.phoneNumber && !this.validateBangladeshPhoneNumber(data.phoneNumber)) {
      errors.push('Invalid Bangladesh phone number format');
    }

    return {
      isValid: errors.length === 0,
      errors,
    };
  }

  private async geocodeAddress(addressData: any): Promise<{ latitude: number; longitude: number }> {
    // This would integrate with a geocoding service
    // For Bangladesh addresses, we could use Google Maps API or local service
    try {
      // Mock implementation - replace with actual geocoding service
      return {
        latitude: 23.8103, // Dhaka coordinates
        longitude: 90.4125,
      };
    } catch (error) {
      throw new BadRequestException('Unable to geocode address');
    }
  }

  async setDefaultAddress(userId: string, addressId: string): Promise<void> {
    // Remove default from all user's addresses
    await this.addressRepository
      .createQueryBuilder()
      .update()
      .set({ isDefault: false })
      .where('userId = :userId', { userId })
      .execute();

    // Set new default
    await this.addressRepository.update(
      { id: addressId, userId },
      { isDefault: true }
    );
  }
}
```

#### 6.5 Implement Account Deletion Process
- Create secure account deletion workflow
- Implement data retention policies
- Add deletion confirmation requirements
- Create deletion grace period
- Implement account recovery options

```typescript
// Account Deletion Service
@Injectable()
export class AccountDeletionService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(DeletionRequest) 
    private deletionRequestRepository: Repository<DeletionRequest>,
  ) {}

  async initiateDeletion(userId: string, reason: string): Promise<DeletionRequest> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Check for pending orders or active subscriptions
    const hasActiveTransactions = await this.checkActiveTransactions(userId);
    if (hasActiveTransactions) {
      throw new BadRequestException('Cannot delete account with active transactions');
    }

    // Create deletion request
    const token = uuidv4();
    const expiresAt = new Date(Date.now() + 7 * 24 * 60 * 60 * 1000); // 7 days

    const deletionRequest = this.deletionRequestRepository.create({
      userId,
      reason,
      token,
      expiresAt,
      status: 'pending_confirmation',
    });

    await this.deletionRequestRepository.save(deletionRequest);

    // Send confirmation email
    await this.sendDeletionConfirmationEmail(user.email, token);

    return deletionRequest;
  }

  async confirmDeletion(token: string): Promise<void> {
    const deletionRequest = await this.deletionRequestRepository.findOne({
      where: { token, status: 'pending_confirmation' },
      relations: ['user'],
    });

    if (!deletionRequest || deletionRequest.expiresAt < new Date()) {
      throw new BadRequestException('Invalid or expired deletion token');
    }

    // Start deletion process
    await this.performAccountDeletion(deletionRequest.userId);

    // Update request status
    await this.deletionRequestRepository.update(
      { id: deletionRequest.id },
      { status: 'completed', completedAt: new Date() }
    );
  }

  private async performAccountDeletion(userId: string): Promise<void> {
    // Soft delete user account
    await this.userRepository.update(
      { id: userId },
      { 
        accountStatus: 'deleted',
        deletedAt: new Date(),
        email: null, // Remove email for privacy
        phoneNumber: null, // Remove phone for privacy
      }
    );

    // Anonymize user data in other systems
    await this.anonymizeUserData(userId);

    // Log account deletion
    await this.logAccountDeletion(userId);
  }

  private async checkActiveTransactions(userId: string): Promise<boolean> {
    // Check for pending orders, active subscriptions, etc.
    // This would integrate with order and subscription services
    return false; // Mock implementation
  }

  private async sendDeletionConfirmationEmail(email: string, token: string): Promise<void> {
    // Send deletion confirmation email
    // This would integrate with email service
  }

  private async anonymizeUserData(userId: string): Promise<void> {
    // Anonymize user data in related systems
    // This would integrate with analytics, reviews, etc.
  }

  private async logAccountDeletion(userId: string): Promise<void> {
    // Log account deletion for audit purposes
    // This would integrate with logging service
  }
}
```

### Acceptance Criteria for Validation
- Profile editing working with proper validation and audit trail
- Avatar upload system functioning with image processing and storage
- Preference management supporting various user settings
- Address book management with Bangladesh-specific validation and geocoding
- Account deletion process working with confirmation and grace period
- All profile operations properly secured and logged

### Estimated Completion Time
- **Total Duration:** 2 days
- **Profile Editing:** 5 hours
- **Avatar Management:** 4 hours
- **Preference Management:** 3 hours
- **Address Book Management:** 4 hours
- **Account Deletion:** 2 hours
- **Testing and Validation:** 2 hours

### Required Resources
- File upload and processing library
- Image optimization tools
- Geocoding service API
- User preference database entities
- Account deletion workflow system

### Validation Checkpoints and Testing Procedures
- Test profile editing with various data scenarios
- Verify avatar upload with different file types and sizes
- Test preference management with various settings
- Validate address book management with Bangladesh addresses
- Test account deletion process with confirmation and recovery

### Technical Specifications
- **Profile Validation:** Comprehensive validation with Bangladesh-specific rules
- **Avatar Processing:** Image resize to 200x200, JPEG format, 5MB max size
- **Preference Storage:** JSON-based with validation rules and defaults
- **Address Validation:** Bangladesh postal codes, phone formats, district validation
- **Account Deletion:** 7-day grace period, soft delete with data anonymization

---

## MILESTONE 7: ADMIN AUTHENTICATION

### Objectives and Goals
Implement enhanced admin authentication system with additional security measures, admin session management, admin activity logging, admin role verification, and admin password policies.

### Detailed Subtasks with Implementation Steps

#### 7.1 Create Admin Login with Enhanced Security
- Implement admin-specific login endpoint
- Add multi-factor authentication requirement
- Create admin session management
- Implement admin device tracking
- Add admin login analytics

```typescript
// Admin Authentication Service
@Injectable()
export class AdminAuthService {
  constructor(
    @InjectRepository(AdminUser) private adminUserRepository: Repository<AdminUser>,
    @InjectRepository(AdminSession) 
    private adminSessionRepository: Repository<AdminSession>,
    private twoFactorAuthService: TwoFactorAuthService,
  ) {}

  async adminLogin(loginDto: AdminLoginDto): Promise<AdminAuthResult> {
    // Validate admin credentials
    const adminUser = await this.validateAdminCredentials(loginDto);
    
    if (!adminUser) {
      // Track failed login attempt
      await this.trackAdminLoginAttempt(loginDto.username, false);
      throw new UnauthorizedException('Invalid admin credentials');
    }

    // Check if 2FA is required for this admin
    if (adminUser.requireTwoFactorAuth) {
      if (!loginDto.twoFactorCode) {
        throw new BadRequestException('Two-factor authentication code is required');
      }

      const isValid2FA = await this.twoFactorAuthService.verifyAdmin2FA(
        adminUser.id,
        loginDto.twoFactorCode
      );

      if (!isValid2FA) {
        // Track failed 2FA attempt
        await this.trackAdminLoginAttempt(loginDto.username, false);
        throw new UnauthorizedException('Invalid two-factor authentication code');
      }
    }

    // Generate admin tokens
    const tokens = await this.generateAdminTokens(adminUser);

    // Track successful login
    await this.trackAdminLoginAttempt(loginDto.username, true);

    // Create admin session
    const session = await this.createAdminSession(adminUser.id, loginDto.deviceInfo);

    return {
      adminUser: {
        id: adminUser.id,
        username: adminUser.username,
        role: adminUser.role,
        permissions: adminUser.permissions,
      },
      ...tokens,
      sessionId: session.id,
    };
  }

  private async validateAdminCredentials(loginDto: AdminLoginDto): Promise<AdminUser> {
    const adminUser = await this.adminUserRepository.findOne({
      where: { username: loginDto.username },
    });

    if (!adminUser) {
      return null;
    }

    const isPasswordValid = await bcrypt.compare(loginDto.password, adminUser.passwordHash);
    if (!isPasswordValid) {
      return null;
    }

    // Check if admin account is active
    if (adminUser.status !== 'active') {
      return null;
    }

    return adminUser;
  }

  private async createAdminSession(
    adminUserId: string, 
    deviceInfo: any
  ): Promise<AdminSession> {
    const session = this.adminSessionRepository.create({
      adminUserId,
      deviceInfo,
      ipAddress: deviceInfo.ipAddress,
      userAgent: deviceInfo.userAgent,
      createdAt: new Date(),
      lastActivity: new Date(),
      expiresAt: new Date(Date.now() + 8 * 60 * 60 * 1000), // 8 hours
    });

    return this.adminSessionRepository.save(session);
  }
}
```

#### 7.2 Implement Admin Session Management
- Create secure admin session storage
- Implement session timeout and cleanup
- Add concurrent session management
- Create session monitoring and alerts
- Implement session invalidation

```typescript
// Admin Session Service
@Injectable()
export class AdminSessionService {
  constructor(
    @InjectRepository(AdminSession) 
    private adminSessionRepository: Repository<AdminSession>,
    @InjectRedis() private readonly redis: Redis,
  ) {}

  async validateSession(sessionId: string): Promise<AdminSession> {
    const session = await this.adminSessionRepository.findOne({
      where: { id: sessionId },
      relations: ['adminUser'],
    });

    if (!session || session.expiresAt < new Date()) {
      throw new UnauthorizedException('Invalid or expired admin session');
    }

    // Update last activity
    session.lastActivity = new Date();
    await this.adminSessionRepository.save(session);

    // Cache session in Redis for quick access
    await this.redis.setex(
      `admin_session:${sessionId}`,
      8 * 60 * 60, // 8 hours
      JSON.stringify(session),
    );

    return session;
  }

  async invalidateSession(sessionId: string): Promise<void> {
    // Remove from database
    await this.adminSessionRepository.update(
      { id: sessionId },
      { isActive: false, invalidatedAt: new Date() }
    );

    // Remove from Redis
    await this.redis.del(`admin_session:${sessionId}`);
  }

  async invalidateAllUserSessions(adminUserId: string): Promise<void> {
    // Invalidate all sessions for specific admin user
    await this.adminSessionRepository.update(
      { adminUserId },
      { isActive: false, invalidatedAt: new Date() }
    );

    // Find and remove from Redis
    const sessions = await this.adminSessionRepository.find({
      where: { adminUserId },
    });

    for (const session of sessions) {
      await this.redis.del(`admin_session:${session.id}`);
    }
  }

  async getActiveSessions(adminUserId: string): Promise<AdminSession[]> {
    return this.adminSessionRepository.find({
      where: { 
        adminUserId,
        isActive: true,
        expiresAt: MoreThan(new Date()),
      },
      order: { lastActivity: 'DESC' },
    });
  }
}
```

#### 7.3 Add Admin Activity Logging
- Create comprehensive admin activity tracking
- Implement activity categorization
- Add admin performance monitoring
- Create suspicious activity detection
- Implement activity audit trail

```typescript
// Admin Activity Service
@Injectable()
export class AdminActivityService {
  constructor(
    @InjectRepository(AdminActivity) 
    private adminActivityRepository: Repository<AdminActivity>,
  ) {}

  async logActivity(
    adminUserId: string, 
    activityType: AdminActivityType,
    details: any,
    ipAddress?: string,
    userAgent?: string
  ): Promise<void> {
    const activity = this.adminActivityRepository.create({
      adminUserId,
      activityType,
      details,
      ipAddress,
      userAgent,
      timestamp: new Date(),
    });

    await this.adminActivityRepository.save(activity);

    // Check for suspicious activities
    await this.checkForSuspiciousActivity(adminUserId, activityType, details);
  }

  async getActivityLog(
    adminUserId?: string, 
    filters?: ActivityFilters
  ): Promise<AdminActivity[]> {
    let query = this.adminActivityRepository.createQueryBuilder('activity');

    if (adminUserId) {
      query = query.where('activity.adminUserId = :adminUserId', { adminUserId });
    }

    if (filters?.activityType) {
      query = query.andWhere('activity.activityType = :activityType', { activityType: filters.activityType });
    }

    if (filters?.startDate) {
      query = query.andWhere('activity.timestamp >= :startDate', { startDate: filters.startDate });
    }

    if (filters?.endDate) {
      query = query.andWhere('activity.timestamp <= :endDate', { endDate: filters.endDate });
    }

    return query
      .orderBy('activity.timestamp', 'DESC')
      .limit(filters?.limit || 100)
      .getMany();
  }

  private async checkForSuspiciousActivity(
    adminUserId: string, 
    activityType: AdminActivityType, 
    details: any
  ): Promise<void> {
    const suspiciousPatterns = {
      // Multiple failed logins from different IPs
      'multiple_failed_logins': {
        check: async () => {
          const recentFailed = await this.getRecentFailedLogins(adminUserId, 15 * 60 * 1000);
          const uniqueIPs = new Set(recentFailed.map(a => a.ipAddress));
          return uniqueIPs.size >= 3;
        },
        alert: 'Multiple failed login attempts from different IP addresses detected',
      },

      // Unusual access times
      'unusual_access_times': {
        check: async () => {
          const recentLogins = await this.getRecentLogins(adminUserId, 24 * 60 * 60 * 1000);
          const hours = recentLogins.map(l => new Date(l.timestamp).getHours());
          const unusualHours = hours.filter(h => h < 6 || h > 22); // Outside 6AM-10PM
          return unusualHours.length > 0;
        },
        alert: 'Admin access detected outside normal business hours',
      },

      // Privilege escalation attempts
      'privilege_escalation': {
        check: async () => {
          const recentPrivilegeChanges = await this.getRecentPrivilegeChanges(adminUserId, 60 * 60 * 1000);
          return recentPrivilegeChanges.length > 5;
        },
        alert: 'Multiple privilege escalation attempts detected',
      },
    };

    // Check each suspicious pattern
    for (const [pattern, config] of Object.entries(suspiciousPatterns)) {
      if (await config.check()) {
        await this.sendSecurityAlert(adminUserId, config.alert);
      }
    }
  }
}
```

#### 7.4 Implement Admin Role Verification
- Create admin role hierarchy validation
- Implement permission verification
- Add role assignment tracking
- Create admin approval workflows
- Implement role change audit trail

```typescript
// Admin Role Verification Service
@Injectable()
export class AdminRoleVerificationService {
  constructor(
    @InjectRepository(AdminUser) private adminUserRepository: Repository<AdminUser>,
    @InjectRepository(AdminRoleChange) 
    private adminRoleChangeRepository: Repository<AdminRoleChange>,
  ) {}

  async verifyAdminRole(
    adminUserId: string, 
    requiredRole: AdminRole
  ): Promise<boolean> {
    const adminUser = await this.adminUserRepository.findOne({
      where: { id: adminUserId },
    relations: ['role'],
    });

    if (!adminUser) {
      throw new NotFoundException('Admin user not found');
    }

    // Check role hierarchy
    const hasRequiredRole = await this.checkRoleHierarchy(adminUser.role, requiredRole);
    
    if (!hasRequiredRole) {
      await this.logRoleVerificationAttempt(adminUserId, requiredRole, false);
      return false;
    }

    await this.logRoleVerificationAttempt(adminUserId, requiredRole, true);
    return true;
  }

  private async checkRoleHierarchy(
    currentRole: AdminRole, 
    requiredRole: AdminRole
  ): Promise<boolean> {
    const roleHierarchy = {
      [AdminRole.SUPER_ADMIN]: 5,
      [AdminRole.ADMIN]: 4,
      [AdminRole.MODERATOR]: 3,
      [AdminRole.SUPPORT]: 2,
      [Admin_ROLE.ANALYST]: 1,
    };

    return roleHierarchy[currentRole] >= roleHierarchy[requiredRole];
  }

  async changeAdminRole(
    adminUserId: string, 
    newRole: AdminRole, 
    changedBy: string, 
    reason: string
  ): Promise<void> {
    const adminUser = await this.adminUserRepository.findOne({
      where: { id: adminUserId },
    });

    if (!adminUser) {
      throw new NotFoundException('Admin user not found');
    }

    // Verify changer has appropriate permissions
    const canChangeRole = await this.verifyAdminRole(changedBy, newRole);
    if (!canChangeRole) {
      throw new ForbiddenException('Insufficient permissions to change admin role');
    }

    // Log role change
    await this.adminRoleChangeRepository.save({
      adminUserId,
      previousRole: adminUser.role,
      newRole,
      changedBy,
      reason,
      changedAt: new Date(),
    });

    // Update user role
    await this.adminUserRepository.update(
      { id: adminUserId },
      { role: newRole, roleUpdatedAt: new Date() }
    );
  }

  private async logRoleVerificationAttempt(
    adminUserId: string, 
    role: AdminRole, 
    success: boolean
  ): Promise<void> {
    // Log verification attempt for audit purposes
    // This would integrate with admin activity service
  }
}
```

#### 7.5 Create Admin Password Policies
- Implement strong password requirements
- Add password expiration policies
- Create password history tracking
- Implement password change notifications
- Add emergency access procedures

```typescript
// Admin Password Policy Service
@Injectable()
export class AdminPasswordPolicyService {
  constructor(
    @InjectRepository(AdminUser) private adminUserRepository: Repository<AdminUser>,
  ) {}

  async validateAdminPassword(password: string): Promise<PasswordValidationResult> {
    // Admin passwords have stricter requirements
    const minLength = 12;
    const requireSpecialChars = true;
    const requireNumbers = true;
    const requireUppercase = true;
    const requireLowercase = true;
    const preventCommonPasswords = true;
    const maxAge = 90; // 90 days

    const errors = [];

    if (password.length < minLength) {
      errors.push(`Password must be at least ${minLength} characters long`);
    }

    if (requireSpecialChars && !/[!@#$%^&*()_+=\-\[\]{}|\\;:'",.<>?]/.test(password)) {
      errors.push('Password must contain at least one special character');
    }

    if (requireNumbers && !/\d/.test(password)) {
      errors.push('Password must contain at least one number');
    }

    if (requireUppercase && !/[A-Z]/.test(password)) {
      errors.push('Password must contain at least one uppercase letter');
    }

    if (requireLowercase && !/[a-z]/.test(password)) {
      errors.push('Password must contain at least one lowercase letter');
    }

    if (preventCommonPasswords && this.isCommonAdminPassword(password)) {
      errors.push('Password is too common. Please choose a stronger password');
    }

    return {
      isValid: errors.length === 0,
      errors,
      strength: this.calculatePasswordStrength(password),
    };
  }

  async checkPasswordAge(adminUserId: string): Promise<boolean> {
    const adminUser = await this.adminUserRepository.findOne({
      where: { id: adminUserId },
    });

    if (!adminUser || !adminUser.passwordChangedAt) {
      return true; // No password to check
    }

    const passwordAge = Date.now() - adminUser.passwordChangedAt.getTime();
    const maxAge = 90 * 24 * 60 * 60 * 1000; // 90 days in milliseconds

    return passwordAge < maxAge;
  }

  async enforcePasswordChange(adminUserId: string): Promise<void> {
    const needsPasswordChange = await this.checkPasswordAge(adminUserId);
    
    if (needsPasswordChange) {
      // Force password change on next login
      await this.adminUserRepository.update(
        { id: adminUserId },
        { requirePasswordChange: true }
      );

      // Send notification
      await this.sendPasswordChangeNotification(adminUserId);
    }
  }

  private isCommonAdminPassword(password: string): boolean {
    const commonAdminPasswords = [
      'admin123', 'password', '12345678', 'admin',
      'saffronadmin', 'bangladesh123', 'dhakaadmin',
      'root', 'toor', 'qwerty', 'letmein',
    ];
    
    return commonAdminPasswords.includes(password.toLowerCase());
  }

  private calculatePasswordStrength(password: string): number {
    let score = 0;

    // Length contributes to score
    if (password.length >= 12) score += 2;
    if (password.length >= 16) score += 2;

    // Character variety
    if (/[a-z]/.test(password)) score += 1;
    if (/[A-Z]/.test(password)) score += 1;
    if (/\d/.test(password)) score += 1;
    if (/[!@#$%^&*()_+=\-\[\]{}|\\;:'",.<>?]/.test(password)) score += 1;

    return Math.min(5, score);
  }

  private async sendPasswordChangeNotification(adminUserId: string): Promise<void> {
    // Send password change notification
    // This would integrate with notification service
  }
}
```

### Acceptance Criteria for Validation
- Admin login implemented with enhanced security measures and 2FA requirement
- Admin session management working with proper timeout and cleanup
- Admin activity logging comprehensive with suspicious activity detection
- Admin role verification implemented with hierarchy validation
- Admin password policies enforced with stricter requirements
- All admin authentication operations properly logged and audited

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Admin Login:** 4 hours
- **Admin Session Management:** 3 hours
- **Admin Activity Logging:** 3 hours
- **Admin Role Verification:** 2 hours
- **Admin Password Policies:** 2 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Admin authentication database entities
- Two-factor authentication system for admin
- Admin activity logging system
- Session management with Redis
- Password policy enforcement tools

### Validation Checkpoints and Testing Procedures
- Test admin login with various scenarios including 2FA
- Verify admin session management with timeout and cleanup
- Validate admin activity logging with suspicious activity detection
- Test admin role verification with different hierarchy levels
- Test admin password policies with various password scenarios

### Technical Specifications
- **Admin Authentication:** Enhanced security with mandatory 2FA for certain roles
- **Session Management:** 8-hour timeout with Redis caching
- **Activity Logging:** Comprehensive categorization with 90-day retention
- **Role Verification:** 5-level hierarchy with change audit trail
- **Password Policies:** 12-character minimum, 90-day expiration, strength requirements

---

## MILESTONE 8: SECURITY MONITORING

### Objectives and Goals
Implement comprehensive security monitoring system with login attempt tracking, suspicious activity detection, security event logging, automated security alerts, and security audit trail.

### Detailed Subtasks with Implementation Steps

#### 8.1 Implement Login Attempt Tracking
- Create comprehensive login attempt logging
- Implement IP-based and user-based tracking
- Add failed login pattern analysis
- Create login attempt analytics
- Implement geographic anomaly detection

```typescript
// Login Attempt Tracking Service
@Injectable()
export class LoginAttemptService {
  constructor(
    @InjectRepository(LoginAttempt) 
    private loginAttemptRepository: Repository<LoginAttempt>,
    @InjectRedis() private readonly redis: Redis,
  ) {}

  async trackLoginAttempt(
    identifier: string, 
    success: boolean, 
    ipAddress: string, 
    userAgent?: string, 
    location?: any
  ): Promise<void> {
    const attempt = this.loginAttemptRepository.create({
      identifier,
      success,
      ipAddress,
      userAgent,
      location,
      attemptTime: new Date(),
    });

    await this.loginAttemptRepository.save(attempt);

    // Update real-time metrics
    await this.updateLoginMetrics(identifier, success, ipAddress);

    // Check for suspicious patterns
    if (!success) {
      await this.analyzeFailedAttempt(identifier, ipAddress, userAgent, location);
    }
  }

  private async updateLoginMetrics(
    identifier: string, 
    success: boolean, 
    ipAddress: string
  ): Promise<void> {
    const today = new Date().toDateString();
    const metricsKey = `login_metrics:${today}:${identifier}`;
    
    // Get current metrics
    const currentMetrics = await this.redis.get(metricsKey);
    const metrics = currentMetrics ? JSON.parse(currentMetrics) : {
      totalAttempts: 0,
      successfulAttempts: 0,
      failedAttempts: 0,
      uniqueIPs: new Set(),
      lastAttempt: null,
    };

    // Update metrics
    metrics.totalAttempts += 1;
    if (success) {
      metrics.successfulAttempts += 1;
    } else {
      metrics.failedAttempts += 1;
    }

    metrics.uniqueIPs.add(ipAddress);
    metrics.lastAttempt = new Date().toISOString();

    await this.redis.setex(metricsKey, 24 * 60 * 60, JSON.stringify(metrics));
  }

  private async analyzeFailedAttempt(
    identifier: string, 
    ipAddress: string, 
    userAgent?: string, 
    location?: any
  ): Promise<void> {
    // Get recent failed attempts
    const recentFailed = await this.getRecentFailedAttempts(identifier, 15 * 60 * 1000);
    
    // Check for patterns
    const uniqueIPs = new Set(recentFailed.map(a => a.ipAddress));
    const uniqueUserAgents = new Set(recentFailed.map(a => a.userAgent).filter(Boolean));
    const recentFailures = recentFailed.length;

    // Trigger alerts for suspicious patterns
    if (uniqueIPs.size >= 3) {
      await this.triggerSecurityAlert('multiple_ips', {
        identifier,
        ipAddress,
        count: uniqueIPs.size,
        timeframe: '15 minutes',
      });
    }

    if (recentFailures >= 10) {
      await this.triggerSecurityAlert('high_failure_rate', {
        identifier,
        count: recentFailures,
        timeframe: '15 minutes',
      });
    }

    if (uniqueUserAgents.size >= 5) {
      await this.triggerSecurityAlert('multiple_user_agents', {
        identifier,
        userAgents: Array.from(uniqueUserAgents),
        count: uniqueUserAgents.size,
      });
    }

    // Geographic anomaly detection
    if (location) {
      const recentLocations = await this.getRecentLocations(identifier, 60 * 60 * 1000);
      const uniqueLocations = new Set(recentLocations.map(l => `${l.latitude},${l.longitude}`));
      
      if (uniqueLocations.size >= 3) {
        await this.triggerSecurityAlert('geographic_anomaly', {
          identifier,
          locations: Array.from(uniqueLocations),
          count: uniqueLocations.size,
          timeframe: '1 hour',
        });
      }
    }
  }

  private async triggerSecurityAlert(
    alertType: string, 
    details: any
  ): Promise<void> {
    // This would integrate with alert service
    console.log(`SECURITY ALERT: ${alertType}`, details);
  }
}
```

#### 8.2 Create Suspicious Activity Detection
- Implement behavioral analysis
- Add anomaly detection algorithms
- Create pattern recognition system
- Implement risk scoring mechanisms
- Add automated response protocols

```typescript
// Suspicious Activity Detection Service
@Injectable()
export class SuspiciousActivityDetectionService {
  constructor(
    @InjectRepository(UserActivity) 
    private userActivityRepository: Repository<UserActivity>,
    @InjectRepository(SecurityAlert) 
    private securityAlertRepository: Repository<SecurityAlert>,
  ) {}

  async analyzeUserBehavior(userId: string): Promise<BehaviorAnalysisResult> {
    // Get recent user activities
    const recentActivities = await this.userActivityRepository.find({
      where: { userId },
      order: { timestamp: 'DESC' },
      take: 100,
    });

    // Analyze patterns
    const analysis = await this.detectAnomalies(recentActivities);
    
    // Calculate risk score
    const riskScore = this.calculateRiskScore(analysis);
    
    // Create security alert if high risk
    if (riskScore >= 7) {
      await this.createSecurityAlert(userId, 'high_risk_behavior', analysis);
    }

    return {
      riskScore,
      anomalies: analysis.anomalies,
      recommendations: analysis.recommendations,
    };
  }

  private async detectAnomalies(activities: UserActivity[]): Promise<any> {
    const anomalies = [];

    // Unusual access times
    const accessTimes = activities
      .filter(a => a.activityType === 'login')
      .map(a => new Date(a.timestamp).getHours());
    
    const usualHours = [9, 10, 11, 14, 15, 16, 17, 18]; // 9AM-6PM
    const unusualHours = accessTimes.filter(h => !usualHours.includes(h));
    
    if (unusualHours.length > 0) {
      anomalies.push({
        type: 'unusual_access_times',
        count: unusualHours.length,
        hours: unusualHours,
      });
    }

    // Rapid successive actions
    const rapidActions = this.detectRapidSuccession(activities);
    if (rapidActions.length > 0) {
      anomalies.push({
        type: 'rapid_succession',
        count: rapidActions.length,
        actions: rapidActions,
      });
    }

    // Unusual data access patterns
    const dataAccessPatterns = this.detectUnusualDataAccess(activities);
    anomalies.push(...dataAccessPatterns);

    // Geographic anomalies
    const geographicAnomalies = await this.detectGeographicAnomalies(activities);
    anomalies.push(...geographicAnomalies);

    return { anomalies };
  }

  private detectRapidSuccession(activities: UserActivity[]): any[] {
    const rapidActions = [];
    const timeWindow = 5 * 60 * 1000; // 5 minutes

    for (let i = 1; i < activities.length - 1; i++) {
      const current = activities[i];
      const next = activities[i + 1];
      
      if (
        next.timestamp - current.timestamp < timeWindow &&
        current.activityType === 'success' &&
        next.activityType === 'success'
      ) {
        rapidActions.push({
          activity: current.activityType,
          timestamp: current.timestamp,
          nextActivity: next.activityType,
          nextTimestamp: next.timestamp,
        });
      }
    }

    return rapidActions;
  }

  private calculateRiskScore(analysis: any): number {
    let score = 0;

    // Base score on anomalies detected
    score += analysis.anomalies.length * 2;

    // Add weight for high-risk anomalies
    for (const anomaly of analysis.anomalies) {
      switch (anomaly.type) {
        case 'unusual_access_times':
          score += 3;
          break;
        case 'rapid_succession':
          score += 2;
          break;
        case 'unusual_data_access':
          score += 4;
          break;
        case 'geographic_anomaly':
          score += 3;
          break;
      }
    }

    return Math.min(10, score);
  }

  private async createSecurityAlert(
    userId: string, 
    alertType: string, 
    details: any
  ): Promise<void> {
    const alert = this.securityAlertRepository.create({
      userId,
      alertType,
      severity: this.getAlertSeverity(alertType),
      details,
      status: 'active',
      createdAt: new Date(),
    });

    await this.securityAlertRepository.save(alert);

    // Trigger immediate notification
    await this.notifySecurityTeam(alert);
  }

  private getAlertSeverity(alertType: string): string {
    const severityMap = {
      'high_risk_behavior': 'critical',
      'multiple_ips': 'high',
      'high_failure_rate': 'high',
      'geographic_anomaly': 'medium',
      'unusual_access_times': 'medium',
      'rapid_succession': 'medium',
    };

    return severityMap[alertType] || 'low';
  }

  private async notifySecurityTeam(alert: SecurityAlert): Promise<void> {
    // This would integrate with notification service
    console.log('SECURITY ALERT CREATED:', alert);
  }
}
```

#### 8.3 Set Up Security Event Logging
- Create comprehensive security event logging
- Implement event categorization
- Add security log retention policies
- Create log analysis and reporting
- Implement log tamper protection

```typescript
// Security Event Logging Service
@Injectable()
export class SecurityEventLoggingService {
  constructor(
    @InjectRepository(SecurityEvent) 
    private securityEventRepository: Repository<SecurityEvent>,
    @InjectRepository(SecurityEventArchive) 
    private securityEventArchiveRepository: Repository<SecurityEventArchive>,
  ) {}

  async logSecurityEvent(
    eventType: SecurityEventType, 
    severity: SecurityEventSeverity,
    details: any,
    userId?: string, 
    ipAddress?: string, 
    userAgent?: string
  ): Promise<void> {
    const event = this.securityEventRepository.create({
      eventType,
      severity,
      details,
      userId,
      ipAddress,
      userAgent,
      timestamp: new Date(),
    });

    await this.securityEventRepository.save(event);

    // Check if immediate notification is needed
    if (severity === 'critical' || severity === 'high') {
      await this.sendImmediateNotification(event);
    }
  }

  async getSecurityEvents(
    filters?: SecurityEventFilters
  ): Promise<SecurityEvent[]> {
    let query = this.securityEventRepository.createQueryBuilder('event');

    if (filters?.eventType) {
      query = query.andWhere('event.eventType = :eventType', { eventType: filters.eventType });
    }

    if (filters?.severity) {
      query = query.andWhere('event.severity = :severity', { severity: filters.severity });
    }

    if (filters?.startDate) {
      query = query.andWhere('event.timestamp >= :startDate', { startDate: filters.startDate });
    }

    if (filters?.endDate) {
      query = query.andWhere('event.timestamp <= :endDate', { endDate: filters.endDate });
    }

    if (filters?.userId) {
      query = query.andWhere('event.userId = :userId', { userId: filters.userId });
    }

    return query
      .orderBy('event.timestamp', 'DESC')
      .limit(filters?.limit || 100)
      .getMany();
  }

  async archiveOldEvents(): Promise<void> {
    const cutoffDate = new Date(Date.now() - 90 * 24 * 60 * 60 * 1000); // 90 days ago

    // Move old events to archive
    const oldEvents = await this.securityEventRepository.find({
      where: { timestamp: LessThan(cutoffDate) },
    });

    for (const event of oldEvents) {
      await this.securityEventArchiveRepository.save({
        ...event,
        archivedAt: new Date(),
      });
    }

    // Delete from main table
    await this.securityEventRepository.delete({
      timestamp: LessThan(cutoffDate),
    });
  }

  private async sendImmediateNotification(event: SecurityEvent): Promise<void> {
    // This would integrate with notification service
    console.log('IMMEDIATE SECURITY NOTIFICATION:', event);
  }
}
```

#### 8.4 Implement Automated Security Alerts
- Create alert rule engine
- Implement notification channels
- Add alert escalation procedures
- Create alert acknowledgment system
- Implement false positive reduction

```typescript
// Security Alert Service
@Injectable()
export class SecurityAlertService {
  constructor(
    @InjectRepository(SecurityAlert) 
    private securityAlertRepository: Repository<SecurityAlert>,
    @InjectRepository(AlertRule) 
    private alertRuleRepository: Repository<AlertRule>,
    private notificationService: NotificationService,
  ) {}

  async processAlert(alert: SecurityAlert): Promise<void> {
    // Check alert rules
    const rules = await this.alertRuleRepository.find({
      where: { 
        eventType: alert.alertType,
        isActive: true,
      },
    });

    for (const rule of rules) {
      if (await this.evaluateRule(alert, rule)) {
        // Take action based on rule
        await this.executeRuleAction(alert, rule);
        break;
      }
    }

    // Update alert status
    await this.securityAlertRepository.update(
      { id: alert.id },
      { 
        status: 'processed',
        processedAt: new Date(),
      }
    );
  }

  private async evaluateRule(alert: SecurityAlert, rule: AlertRule): Promise<boolean> {
    switch (rule.conditionType) {
      case 'severity_threshold':
        return alert.severity === rule.conditionValue;
      
      case 'time_based':
        const timeSinceCreation = Date.now() - alert.createdAt.getTime();
        return timeSinceCreation >= parseInt(rule.conditionValue);
      
      case 'frequency_threshold':
        const recentAlerts = await this.getRecentAlerts(
          alert.userId,
          alert.alertType,
          parseInt(rule.conditionValue)
        );
        return recentAlerts.length >= parseInt(rule.conditionValue);
      
      default:
        return false;
    }
  }

  private async executeRuleAction(
    alert: SecurityAlert, 
    rule: AlertRule
  ): Promise<void> {
    switch (rule.actionType) {
      case 'notify_admin':
        await this.notifyAdministrators(alert);
        break;
        
      case 'block_user':
        await this.blockUser(alert.userId);
        break;
        
      case 'require_2fa':
        await this.requireTwoFactorAuth(alert.userId);
        break;
        
      case 'log_out_user':
        await this.logoutUser(alert.userId);
        break;
    }
  }

  async acknowledgeAlert(
    alertId: string, 
    acknowledgedBy: string, 
    notes?: string
  ): Promise<void> {
    await this.securityAlertRepository.update(
      { id: alertId },
      { 
        status: 'acknowledged',
        acknowledgedBy,
        acknowledgedAt: new Date(),
        notes,
      }
    );
  }

  async getActiveAlerts(): Promise<SecurityAlert[]> {
    return this.securityAlertRepository.find({
      where: { 
        status: 'active',
        createdAt: MoreThan(new Date(Date.now() - 24 * 60 * 60 * 1000)), // Last 24 hours
      },
      order: { severity: 'DESC', createdAt: 'DESC' },
    });
  }
}
```

#### 8.5 Create Security Audit Trail
- Implement comprehensive audit logging
- Add audit trail integrity protection
- Create audit report generation
- Implement audit log retention policies
- Add audit trail analytics

```typescript
// Security Audit Trail Service
@Injectable()
export class SecurityAuditTrailService {
  constructor(
    @InjectRepository(SecurityAudit) 
    private securityAuditRepository: Repository<SecurityAudit>,
    @InjectRepository(SecurityAuditArchive) 
    private securityAuditArchiveRepository: Repository<SecurityAuditArchive>,
  ) {}

  async logAuditEvent(
    category: AuditCategory, 
    action: string, 
    details: any, 
    userId?: string, 
    ipAddress?: string, 
    userAgent?: string
  ): Promise<void> {
    const audit = this.securityAuditRepository.create({
      category,
      action,
      details,
      userId,
      ipAddress,
      userAgent,
      timestamp: new Date(),
      checksum: this.generateChecksum(details),
    });

    await this.securityAuditRepository.save(audit);

    // Check for critical audit events
    if (this.isCriticalAuditEvent(category, action)) {
      await this.sendCriticalAuditNotification(audit);
    }
  }

  async getAuditTrail(
    filters?: AuditFilters
  ): Promise<SecurityAudit[]> {
    let query = this.securityAuditRepository.createQueryBuilder('audit');

    if (filters?.category) {
      query = query.andWhere('audit.category = :category', { category: filters.category });
    }

    if (filters?.action) {
      query = query.andWhere('audit.action = :action', { action: filters.action });
    }

    if (filters?.userId) {
      query = query.andWhere('audit.userId = :userId', { userId: filters.userId });
    }

    if (filters?.startDate) {
      query = query.andWhere('audit.timestamp >= :startDate', { startDate: filters.startDate });
    }

    if (filters?.endDate) {
      query = query.andWhere('audit.timestamp <= :endDate', { endDate: filters.endDate });
    }

    return query
      .orderBy('audit.timestamp', 'DESC')
      .limit(filters?.limit || 100)
      .getMany();
  }

  async verifyAuditIntegrity(): Promise<IntegrityReport> {
    const recentAudits = await this.securityAuditRepository.find({
      where: { 
        timestamp: MoreThan(new Date(Date.now() - 7 * 24 * 60 * 60 * 1000)), // Last 7 days
      },
      take: 1000,
    });

    const issues = [];

    // Check for missing checksums
    const missingChecksums = recentAudits.filter(audit => !audit.checksum);
    if (missingChecksums.length > 0) {
      issues.push({
        type: 'missing_checksum',
        count: missingChecksums.length,
        severity: 'high',
      });
    }

    // Check for gaps in sequence
    const sortedAudits = recentAudits.sort((a, b) => 
      new Date(a.timestamp).getTime() - new Date(b.timestamp).getTime()
    );

    for (let i = 1; i < sortedAudits.length; i++) {
      const gap = sortedAudits[i].timestamp - sortedAudits[i - 1].timestamp;
      if (gap > 5 * 60 * 1000) { // 5 minutes gap
        issues.push({
          type: 'sequence_gap',
          duration: gap,
          severity: 'medium',
        });
      }
    }

    return {
      totalAudits: recentAudits.length,
      issuesFound: issues.length,
      issues,
    };
  }

  private generateChecksum(details: any): string {
    // Generate checksum for audit integrity
    const crypto = require('crypto');
    return crypto
      .createHash('sha256')
      .update(JSON.stringify(details))
      .digest('hex');
  }

  private isCriticalAuditEvent(category: AuditCategory, action: string): boolean {
    const criticalEvents = [
      { category: 'authentication', action: 'login_failure' },
      { category: 'authentication', action: 'privilege_escalation' },
      { category: 'authorization', action: 'access_denied' },
      { category: 'data_modification', action: 'sensitive_data_access' },
      { category: 'system', action: 'configuration_change' },
    ];

    return criticalEvents.some(event => 
      event.category === category && event.action === action
    );
  }

  private async sendCriticalAuditNotification(audit: SecurityAudit): Promise<void> {
    // This would integrate with notification service
    console.log('CRITICAL AUDIT EVENT:', audit);
  }

  async archiveOldAudits(): Promise<void> {
    const cutoffDate = new Date(Date.now() - 365 * 24 * 60 * 60 * 1000)); // 1 year ago

    // Move old audits to archive
    const oldAudits = await this.securityAuditRepository.find({
      where: { timestamp: LessThan(cutoffDate) },
    });

    for (const audit of oldAudits) {
      await this.securityAuditArchiveRepository.save({
        ...audit,
        archivedAt: new Date(),
      });
    }

    // Delete from main table
    await this.securityAuditRepository.delete({
      timestamp: LessThan(cutoffDate),
    });
  }
}
```

### Acceptance Criteria for Validation
- Login attempt tracking implemented with comprehensive pattern analysis
- Suspicious activity detection working with behavioral analysis and risk scoring
- Security event logging comprehensive with categorization and retention policies
- Automated security alerts functioning with rule engine and escalation procedures
- Security audit trail implemented with integrity protection and reporting
- All monitoring systems properly integrated and providing actionable insights

### Estimated Completion Time
- **Total Duration:** 2 days
- **Login Attempt Tracking:** 4 hours
- **Suspicious Activity Detection:** 5 hours
- **Security Event Logging:** 3 hours
- **Automated Security Alerts:** 4 hours
- **Security Audit Trail:** 4 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Security monitoring database entities
- Anomaly detection algorithms
- Alert rule engine
- Notification system integration
- Audit trail integrity verification tools

### Validation Checkpoints and Testing Procedures
- Test login attempt tracking with various scenarios and IP addresses
- Verify suspicious activity detection with behavioral patterns
- Test security event logging with different event types and severities
- Validate automated security alerts with rule evaluation and escalation
- Test security audit trail with integrity verification and reporting

### Technical Specifications
- **Login Tracking:** 15-minute windows with pattern analysis and geographic detection
- **Activity Detection:** Behavioral analysis with risk scoring (0-10 scale)
- **Event Logging:** Categorized logging with 90-day active retention and 1-year archive
- **Security Alerts:** Rule-based engine with multiple action types and escalation
- **Audit Trail:** SHA-256 checksums with sequence gap detection and integrity reports

---

## MILESTONE 9: DATA PROTECTION

### Objectives and Goals
Implement comprehensive data protection measures including data encryption at rest, secure data transmission, data anonymization for analytics, GDPR compliance features, and data retention policies.

### Detailed Subtasks with Implementation Steps

#### 9.1 Set Up Data Encryption at Rest
- Implement database encryption
- Create file storage encryption
- Add sensitive data field encryption
- Implement key management system
- Create encryption monitoring and alerts

```typescript
// Data Encryption Service
@Injectable()
export class DataEncryptionService {
  constructor(
    @InjectRepository(EncryptionKey) 
    private encryptionKeyRepository: Repository<EncryptionKey>,
  ) {}

  async encryptSensitiveData(data: string, keyId?: string): Promise<string> {
    const key = await this.getEncryptionKey(keyId);
    
    // Use AES-256-GCM for encryption
    const algorithm = 'aes-256-gcm';
    const secretKey = crypto.createSecretKey(key.key, 'hex');
    const cipher = crypto.createCipher(algorithm, secretKey);
    
    let encrypted = cipher.update(data, 'utf8', 'hex');
    encrypted = cipher.final('hex');
    
    // Return IV + encrypted data
    return cipher.getAuthTag().toString('hex') + ':' + encrypted;
  }

  async decryptSensitiveData(encryptedData: string, keyId?: string): Promise<string> {
    const key = await this.getEncryptionKey(keyId);
    
    // Split IV and encrypted data
    const parts = encryptedData.split(':');
    const iv = Buffer.from(parts[0], 'hex');
    const encrypted = Buffer.from(parts[1], 'hex');
    
    const algorithm = 'aes-256-gcm';
    const secretKey = crypto.createSecretKey(key.key, 'hex');
    const decipher = crypto.createDecipher(algorithm, secretKey);
    
    decipher.setAuthTag(Buffer.from(parts[0], 'hex'));
    let decrypted = decipher.update(encrypted, 'hex', 'utf8');
    decrypted = decipher.final('utf8');
    
    return decrypted;
  }

  async encryptDatabaseFields(): Promise<void> {
    // This would integrate with database encryption
    // For PostgreSQL, we could use pgcrypto extension
    console.log('Database field encryption implemented');
  }

  async encryptFileStorage(): Promise<void> {
    // This would integrate with file storage encryption
    // For cloud storage, implement server-side encryption
    console.log('File storage encryption implemented');
  }

  private async getEncryptionKey(keyId?: string): Promise<EncryptionKey> {
    if (keyId) {
      const key = await this.encryptionKeyRepository.findOne({
        where: { id: keyId, isActive: true },
      });
      
      if (!key) {
        throw new NotFoundException('Encryption key not found');
      }
      
      return key;
    }

    // Get default active key
    const defaultKey = await this.encryptionKeyRepository.findOne({
      where: { isDefault: true, isActive: true },
    });
      
    if (!defaultKey) {
      throw new NotFoundException('Default encryption key not found');
    }
      
    return defaultKey;
  }
}
```

#### 9.2 Implement Secure Data Transmission
- Create HTTPS enforcement
- Implement API encryption
- Add secure header configurations
- Create certificate management
- Implement data integrity verification

```typescript
// Secure Data Transmission Service
@Injectable()
export class SecureDataTransmissionService {
  constructor() {}

  enforceHTTPS(req: any, res: any, next: any): void {
    // Redirect HTTP to HTTPS
    if (!req.secure) {
      const httpsUrl = `https://${req.headers.host}${req.url}`;
      return res.redirect(301, httpsUrl);
    }

    // Set security headers
    res.setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
    res.setHeader('X-Content-Type-Options', 'nosniff');
    res.setHeader('X-Frame-Options', 'DENY');
    res.setHeader('X-XSS-Protection', '1; mode=block');
    
    next();
  }

  validateAPIRequest(req: any): boolean {
    // Validate request for secure transmission
    if (!req.secure) {
      return false;
    }

    // Check for proper headers
    const requiredHeaders = ['authorization', 'content-type'];
    for (const header of requiredHeaders) {
      if (!req.headers[header.toLowerCase()]) {
        return false;
      }
    }

    return true;
  }

  setupSecureHeaders(res: any): void {
    // HSTS header
    res.setHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
    
    // Content Security Policy
    const csp = [
      "default-src 'self'",
      "script-src 'self'",
      "style-src 'self' 'unsafe-inline'",
      "img-src 'self' data: https:",
      "font-src 'self' https:",
      "connect-src 'self'",
      "frame-ancestors 'none'",
    ].join('; ');
    
    res.setHeader('Content-Security-Policy', csp);
    
    // Other security headers
    res.setHeader('X-Content-Type-Options', 'nosniff');
    res.setHeader('X-Frame-Options', 'DENY');
    res.setHeader('X-XSS-Protection', '1; mode=block');
  }

  async validateCertificate(): Promise<CertificateValidationResult> {
    // This would validate SSL/TLS certificates
    try {
      // Check certificate expiration
      const cert = await this.getCurrentCertificate();
      const now = new Date();
      
      if (cert.validTo && cert.validTo < now) {
        return {
          isValid: false,
          error: 'Certificate expires soon',
          expiresAt: cert.validTo,
        };
      }

      // Check certificate chain
      const chainValid = await this.validateCertificateChain(cert);
      
      return {
        isValid: chainValid,
        error: chainValid ? null : 'Invalid certificate chain',
      };
    } catch (error) {
      return {
        isValid: false,
        error: 'Certificate validation failed',
      };
    }
  }
}
```

#### 9.3 Create Data Anonymization for Analytics
- Implement personal data removal
- Create analytics data aggregation
- Add privacy-preserving analytics
- Implement data minimization techniques
- Create anonymization audit trail

```typescript
// Data Anonymization Service
@Injectable()
export class DataAnonymizationService {
  constructor() {}

  anonymizeUserData(userData: any): any {
    const anonymized = { ...userData };

    // Remove direct identifiers
    delete anonymized.id;
    delete anonymized.email;
    delete anonymized.phoneNumber;
    delete anonymized.ipAddress;
    delete anonymized.userAgent;

    // Anonymize name fields
    if (anonymized.firstName) {
      anonymized.firstName = this.generateRandomName();
    }
    
    if (anonymized.lastName) {
      anonymized.lastName = this.generateRandomName();
    }

    // Generalize location data
    if (anonymized.city) {
      anonymized.city = this.generalizeLocation(anonymized.city);
    }

    if (anonymized.address) {
      anonymized.address = this.generalizeLocation(anonymized.address);
    }

    // Add anonymization metadata
    anonymized.anonymizedAt = new Date();
    anonymized.anonymizationMethod = 'automatic';
    anonymized.dataRetentionDays = 365;

    return anonymized;
  }

  anonymizeOrderData(orderData: any): any {
    const anonymized = { ...orderData };

    // Remove user identifiers
    delete anonymized.customerId;
    delete anonymized.customerEmail;
    delete anonymized.customerPhone;

    // Generalize shipping address
    if (anonymized.shippingAddress) {
      anonymized.shippingAddress = this.generalizeLocation(anonymized.shippingAddress);
    }

    // Preserve order analytics but remove personal data
    anonymized.orderTotal = orderData.orderTotal;
    anonymized.itemCount = orderData.itemCount;
    anonymized.orderDate = this.generalizeDate(orderData.orderDate);

    return anonymized;
  }

  createPrivacyPreservingAnalytics(data: any[]): any {
    // Aggregate data without personal identifiers
    const aggregated = {
      totalUsers: data.length,
      activeUsers: data.filter(u => u.isActive).length,
      newUsersToday: data.filter(u => 
        this.isToday(u.createdAt) && u.createdAt > new Date(Date.now() - 24 * 60 * 60 * 1000))
      ).length,
      
      // Geographic distribution (generalized)
      geographicDistribution: this.generalizeGeographicData(
        data.map(u => u.location)
      ),
      
      // Behavioral patterns (anonymized)
      behavioralPatterns: this.anonymizeBehavioralPatterns(
        data.map(u => u.activities)
      ),
    };

    return aggregated;
  }

  private generateRandomName(): string {
    const surnames = ['Hossain', 'Islam', 'Khan', 'Ahmed', 'Rahman', 'Chowdhury'];
    const givenNames = ['Muhammad', 'Abdul', 'Fatima', 'Aisha', 'Khadija', 'Taslim'];
    
    return `${this.randomElement(givenNames)} ${this.randomElement(surnames)}`;
  }

  private generalizeLocation(location: string): string {
    // Replace specific addresses with general areas
    const dhakaAreas = ['Dhanmondi', 'Mirpur', 'Gulshan', 'Uttara', 'Mohammadpur'];
    const chittagongAreas = ['Kotwali', 'Chandpur', 'Bagerhat', 'Jessore', 'Shariatpur'];
    
    // Check if location matches any known area
    for (const area of [...dhakaAreas, ...chittagongAreas]) {
      if (location.toLowerCase().includes(area.toLowerCase())) {
        return area;
      }
    }
    
    return 'General Area';
  }

  private generalizeDate(date: Date): string {
    // Remove specific dates, keep only month/year
    return `${date.getFullYear()}-${date.getMonth() + 1}`;
  }

  private randomElement(array: string[]): string {
    return array[Math.floor(Math.random() * array.length)];
  }

  private isToday(date: Date): boolean {
    const today = new Date();
    return date.toDateString() === today.toDateString();
  }

  private async anonymizeBehavioralPatterns(activities: any[]): any {
    // Analyze patterns without personal data
    const loginFrequency = activities.filter(a => a.type === 'login').length;
    const avgSessionDuration = this.calculateAverageSessionDuration(activities);
    const peakHours = this.calculatePeakHours(activities);

    return {
      loginFrequency,
      avgSessionDuration,
      peakHours,
    };
  }
}
```

#### 9.4 Implement GDPR Compliance Features
- Create data subject rights management
- Implement consent management
- Add data portability features
- Create right to be forgotten implementation
- Add privacy policy management

```typescript
// GDPR Compliance Service
@Injectable()
export class GDPRComplianceService {
  constructor(
    @InjectRepository(User) private userRepository: Repository<User>,
    @InjectRepository(ConsentRecord) 
    private consentRecordRepository: Repository<ConsentRecord>,
    @InjectRepository(DataProcessingRecord) 
    private dataProcessingRepository: Repository<DataProcessingRecord>,
  ) {}

  async updateConsent(
    userId: string, 
    consentData: ConsentUpdateDto
  ): Promise<void> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Create consent record
    const consent = this.consentRecordRepository.create({
      userId,
      consentType: consentData.consentType,
      granted: consentData.granted,
      ipAddress: consentData.ipAddress,
      userAgent: consentData.userAgent,
      timestamp: new Date(),
      validUntil: consentData.validUntil,
    });

    await this.consentRecordRepository.save(consent);

    // Update user consent status
    await this.userRepository.update(
      { id: userId },
      { 
        gdprConsentUpdated: new Date(),
        privacyPolicyAccepted: consentData.privacyPolicyAccepted,
        marketingConsent: consentData.marketingConsent,
      }
    );
  }

  async processDataRequest(
    userId: string, 
    requestType: string, 
    purpose: string, 
    legalBasis: string
  ): Promise<void> {
    // Create data processing record
    const processing = this.dataProcessingRepository.create({
      userId,
      requestType,
      purpose,
      legalBasis,
      status: 'processing',
      requestedAt: new Date(),
    });

    await this.dataProcessingRepository.save(processing);

    // Log processing request
    await this.logDataProcessingRequest(userId, requestType, purpose);
  }

  async exportUserData(userId: string): Promise<string> {
    const user = await this.userRepository.findOne({
      where: { id: userId },
    });

    if (!user) {
      throw new NotFoundException('User not found');
    }

    // Collect user data in GDPR-compliant format
    const userData = await this.collectUserDataForExport(user);

    // Create export record
    const exportRecord = this.dataProcessingRepository.create({
      userId,
      requestType: 'data_export',
      purpose: 'User requested data export',
      legalBasis: 'User consent',
      status: 'completed',
      requestedAt: new Date(),
      completedAt: new Date(),
    });

    await this.dataProcessingRepository.save(exportRecord);

    // Generate export file (JSON, CSV, etc.)
    const exportData = this.generateExportFile(userData);

    // Store export file securely
    const exportUrl = await this.storeExportFile(exportData, userId);

    return exportUrl;
  }

  async deleteUserData(userId: string, reason: string): Promise<void> {
    // Create deletion request
    const deletion = this.dataProcessingRepository.create({
      userId,
      requestType: 'data_deletion',
      purpose: 'User requested data deletion',
      legalBasis: 'User consent',
      reason,
      status: 'processing',
      requestedAt: new Date(),
    });

    await this.dataProcessingRepository.save(deletion);

    // Schedule actual deletion (30 days grace period)
    const deletionDate = new Date(Date.now() + 30 * 24 * 60 * 60 * 1000);
    
    await this.scheduleDataDeletion(userId, deletionDate);

    // Send confirmation
    await this.sendDeletionConfirmation(userId, deletionDate);
  }

  private async collectUserDataForExport(user: User): Promise<any> {
    // Collect all user data in structured format
    return {
      personalData: {
        firstName: user.firstName,
        lastName: user.lastName,
        email: user.email,
        phoneNumber: user.phoneNumber,
        dateOfBirth: user.dateOfBirth,
        registrationDate: user.createdAt,
      },
      orders: await this.getUserOrders(user.id),
      preferences: await this.getUserPreferences(user.id),
      addresses: await this.getUserAddresses(user.id),
    };
  }

  private async scheduleDataDeletion(userId: string, deletionDate: Date): Promise<void> {
    // Schedule background job for actual deletion
    console.log(`Scheduled data deletion for user ${userId} on ${deletionDate}`);
  }

  private async sendDeletionConfirmation(userId: string, deletionDate: Date): Promise<void> {
    // Send deletion confirmation email
    console.log(`Sent deletion confirmation to user ${userId} for deletion on ${deletionDate}`);
  }
}
```

#### 9.5 Set Up Data Retention Policies
- Create retention schedule management
- Implement automatic data cleanup
- Add retention policy enforcement
- Create retention audit logging
- Implement legal hold procedures

```typescript
// Data Retention Service
@Injectable()
export class DataRetentionService {
  constructor(
    @InjectRepository(RetentionPolicy) 
    private retentionPolicyRepository: Repository<RetentionPolicy>,
  ) {}

  async applyRetentionPolicy(
    dataType: string, 
    dataId: string
  ): Promise<void> {
    const policy = await this.retentionPolicyRepository.findOne({
      where: { dataType, isActive: true },
    });

    if (!policy) {
      throw new NotFoundException('Retention policy not found for data type');
    }

    // Calculate retention period
    const retentionPeriod = this.calculateRetentionPeriod(policy);
    const cutoffDate = new Date(Date.now() - retentionPeriod);

    // Apply retention based on data type
    switch (dataType) {
      case 'user_activity':
        await this.archiveUserActivity(dataId, cutoffDate);
        break;
        
      case 'security_logs':
        await this.archiveSecurityLogs(dataId, cutoffDate);
        break;
        
      case 'analytics_data':
        await this.anonymizeAnalyticsData(dataId, cutoffDate);
        break;
        
      case 'payment_data':
        await this.archivePaymentData(dataId, cutoffDate);
        break;
        
      default:
        await this.deleteGenericData(dataId, cutoffDate);
    }

    // Log retention action
    await this.logRetentionAction(dataType, dataId, policy, cutoffDate);
  }

  private calculateRetentionPeriod(policy: RetentionPolicy): number {
    // Convert policy to milliseconds
    switch (policy.periodUnit) {
      case 'days':
        return policy.periodValue * 24 * 60 * 60 * 1000;
      case 'months':
        return policy.periodValue * 30 * 24 * 60 * 60 * 1000;
      case 'years':
        return policy.periodValue * 365 * 24 * 60 * 60 * 1000;
      default:
        return 90 * 24 * 60 * 60 * 1000; // 90 days default
    }
  }

  async archiveUserActivity(dataId: string, cutoffDate: Date): Promise<void> {
    // Move user activity to archive
    console.log(`Archived user activity ${dataId} with cutoff date ${cutoffDate}`);
  }

  async archiveSecurityLogs(dataId: string, cutoffDate: Date): Promise<void> {
    // Move security logs to archive
    console.log(`Archived security logs ${dataId} with cutoff date ${cutoffDate}`);
  }

  async anonymizeAnalyticsData(dataId: string, cutoffDate: Date): Promise<void> {
    // Anonymize analytics data before archiving
    console.log(`Anonymized analytics data ${dataId} with cutoff date ${cutoffDate}`);
  }

  async archivePaymentData(dataId: string, cutoffDate: Date): Promise<void> {
    // Archive payment data according to retention policy
    console.log(`Archived payment data ${dataId} with cutoff date ${cutoffDate}`);
  }

  async deleteGenericData(dataId: string, cutoffDate: Date): Promise<void> {
    // Delete data past retention period
    console.log(`Deleted generic data ${dataId} with cutoff date ${cutoffDate}`);
  }

  private async logRetentionAction(
    dataType: string, 
    dataId: string, 
    policy: RetentionPolicy, 
    cutoffDate: Date
  ): Promise<void> {
    // Log retention action for audit purposes
    console.log(`Applied retention policy for ${dataType} (${dataId}):`, {
      policy,
      cutoffDate,
      timestamp: new Date(),
    });
  }
}
```

### Acceptance Criteria for Validation
- Data encryption at rest implemented with AES-256-GCM and key management
- Secure data transmission working with HTTPS enforcement and security headers
- Data anonymization functioning with privacy-preserving analytics
- GDPR compliance features implemented with consent management and data portability
- Data retention policies working with automatic cleanup and audit logging
- All data protection measures compliant with Bangladesh regulations

### Estimated Completion Time
- **Total Duration:** 1.5 days
- **Data Encryption at Rest:** 4 hours
- **Secure Data Transmission:** 3 hours
- **Data Anonymization:** 3 hours
- **GDPR Compliance:** 3 hours
- **Data Retention Policies:** 2 hours
- **Testing and Validation:** 1 hour

### Required Resources
- Encryption libraries and key management system
- SSL/TLS certificate management tools
- Data anonymization algorithms
- GDPR compliance framework
- Data retention policy management system

### Validation Checkpoints and Testing Procedures
- Test data encryption with various data types and key management
- Verify secure data transmission with different protocols and headers
- Test data anonymization with privacy preservation validation
- Validate GDPR compliance features with consent management and data export
- Test data retention policies with automatic cleanup and audit logging

### Technical Specifications
- **Encryption:** AES-256-GCM with key rotation every 90 days
- **Transmission:** TLS 1.2+ with HSTS header (1-year max-age)
- **Anonymization:** Irreversible hashing with k-anonymity (k=1000)
- **GDPR Compliance:** Consent management with 6-month retention and right to deletion
- **Retention Policies:** Configurable periods with automatic cleanup and audit logging

---

## MILESTONE 10: SECURITY VERIFICATION

### Objectives and Goals
Conduct comprehensive security verification including penetration testing, authentication flow verification, authorization controls validation, data protection measures verification, and security documentation creation.

### Detailed Subtasks with Implementation Steps

#### 10.1 Conduct Security Penetration Testing
- Implement automated vulnerability scanning
- Conduct manual penetration testing
- Test common attack vectors
- Create security assessment reports
- Implement remediation tracking

```typescript
// Security Penetration Testing Service
@Injectable()
export class SecurityPenetrationTestingService {
  constructor() {}

  async runVulnerabilityScan(): Promise<VulnerabilityReport> {
    const vulnerabilities = [];

    // Test for common vulnerabilities
    const testResults = await Promise.all([
      this.testSQLInjection(),
      this.testXSSVulnerabilities(),
      this.testCSRFVulnerabilities(),
      this.testAuthenticationBypass(),
      this.testInsecureDirectObjectReferences(),
      this.testSecurityMisconfigurations(),
      this.testSensitiveDataExposure(),
    ]);

    for (const result of testResults) {
      if (!result.passed) {
        vulnerabilities.push({
          type: result.type,
          severity: result.severity,
          description: result.description,
          recommendation: result.recommendation,
        });
      }
    }

    return {
      scanDate: new Date(),
      totalVulnerabilities: vulnerabilities.length,
      criticalVulnerabilities: vulnerabilities.filter(v => v.severity === 'critical').length,
      highVulnerabilities: vulnerabilities.filter(v => v.severity === 'high').length,
      mediumVulnerabilities: vulnerabilities.filter(v => v.severity === 'medium').length,
      lowVulnerabilities: vulnerabilities.filter(v => v.severity === 'low').length,
      vulnerabilities,
    };
  }

  async testSQLInjection(): Promise<TestResult> {
    // Test various SQL injection payloads
    const payloads = [
      "' OR '1'='1",
      "'; DROP TABLE users; --",
      "' UNION SELECT * FROM users",
      "1' AND (SELECT COUNT(*) FROM users) > 0",
    ];

    for (const payload of payloads) {
      const result = await this.testPayload(payload, 'sql_injection');
      if (!result.passed) {
        return { passed: false, payload, error: result.error };
      }
    }

    return { passed: true, type: 'sql_injection' };
  }

  async testXSSVulnerabilities(): Promise<TestResult> {
    // Test various XSS payloads
    const payloads = [
      '<script>alert("XSS")</script>',
      '<img src=x onerror=alert("XSS")>',
      'javascript:alert("XSS")',
      '<svg onload=alert("XSS")>',
      '"><script>alert("XSS")</script>',
    ];

    for (const payload of payloads) {
      const result = await this.testPayload(payload, 'xss');
      if (!result.passed) {
        return { passed: false, payload, error: result.error };
      }
    }

    return { passed: true, type: 'xss' };
  }

  async testCSRFVulnerabilities(): Promise<TestResult> {
    // Test for CSRF protection
    const result = await this.testCSRFToken();
    
    return result;
  }

  async testAuthenticationBypass(): Promise<TestResult> {
    // Test for authentication bypass attempts
    const tests = [
      this.testPasswordComplexity(),
      this.testSessionFixation(),
      this.testBruteForceProtection(),
      this.testAccountLockoutBypass(),
    ];

    for (const test of tests) {
      if (!test.passed) {
        return test;
      }
    }

    return { passed: true, type: 'authentication_bypass' };
  }

  private async testPayload(payload: string, testType: string): Promise<TestResult> {
    // This would send payload to test endpoint
    try {
      const response = await axios.post(`${process.env.API_URL}/test`, { payload });
      
      // Check if payload was executed or sanitized
      const containsPayload = response.data.includes(payload);
      const wasSanitized = response.status === 400 && response.data.includes('sanitized');
      
      return {
        passed: wasSanitized || !containsPayload,
        payload,
        error: wasSanitized ? 'Payload was sanitized' : 'Payload was executed',
        testType,
      };
    } catch (error) {
      return {
        passed: false,
        error: error.message,
        testType,
      };
    }
  }
}
```

#### 10.2 Verify Authentication Flows
- Test complete user authentication journey
- Validate password security measures
- Test social login integration
- Verify 2FA functionality
- Test admin authentication flows

```typescript
// Authentication Flow Testing Service
@Injectable()
export class AuthenticationFlowTestingService {
  constructor() {}

  async testCompleteUserJourney(): Promise<TestResult[]> {
    const testResults = [];

    // Test registration flow
    const registrationResult = await this.testRegistrationFlow();
    testResults.push(registrationResult);

    // Test email verification
    const emailVerificationResult = await this.testEmailVerificationFlow();
    testResults.push(emailVerificationResult);

    // Test phone verification
    const phoneVerificationResult = await this.testPhoneVerificationFlow();
    testResults.push(phoneVerificationResult);

    // Test login flow
    const loginResult = await this.testLoginFlow();
    testResults.push(loginResult);

    // Test password reset flow
    const passwordResetResult = await this.testPasswordResetFlow();
    testResults.push(passwordResetResult);

    // Test 2FA setup and usage
    const twoFactorResult = await this.testTwoFactorFlow();
    testResults.push(twoFactorResult);

    // Test profile management
    const profileResult = await this.testProfileManagementFlow();
    testResults.push(profileResult);

    return testResults;
  }

  async testRegistrationFlow(): Promise<TestResult> {
    const testCases = [
      { name: 'Valid registration', data: this.generateValidRegistrationData() },
      { name: 'Duplicate email', data: this.generateRegistrationData({ email: 'existing@example.com' }) },
      { name: 'Invalid phone format', data: this.generateRegistrationData({ phoneNumber: '123' }) },
      { name: 'Weak password', data: this.generateRegistrationData({ password: '123' }) },
      { name: 'Missing required fields', data: this.generateRegistrationData({ firstName: '' }) },
    ];

    const results = [];
    for (const testCase of testCases) {
      const result = await this.executeRegistrationTest(testCase.data);
      results.push({
        testCase: testCase.name,
        passed: result.passed,
        error: result.error,
        response: result.response,
      });
    }

    return {
      testType: 'registration',
      totalTests: testCases.length,
      passedTests: results.filter(r => r.passed).length,
      failedTests: results.filter(r => !r.passed).length,
      results,
    };
  }

  async testTwoFactorFlow(): Promise<TestResult> {
    const testCases = [
      { name: 'Valid 2FA setup', data: this.generateValid2FAData() },
      { name: 'Invalid backup code', data: this.generateValid2FAData({ backupCode: '123456' }) },
      { name: 'Expired backup code', data: this.generateValid2FAData({ backupCodeExpired: true }) },
      { name: '2FA bypass attempt', data: this.generateValid2FAData({ bypassAttempt: true }) },
    ];

    const results = [];
    for (const testCase of testCases) {
      const result = await this.execute2FATest(testCase.data);
      results.push({
        testCase: testCase.name,
        passed: result.passed,
        error: result.error,
        response: result.response,
      });
    }

    return {
      testType: 'two_factor_authentication',
      totalTests: testCases.length,
      passedTests: results.filter(r => r.passed).length,
      failedTests: results.filter(r => !r.passed).length,
      results,
    };
  }

  private async executeRegistrationTest(data: any): Promise<any> {
    try {
      const response = await axios.post(`${process.env.API_URL}/auth/register`, data);
      
      return {
        passed: response.status === 201,
        error: response.status === 201 ? null : this.extractErrorMessage(response),
        response: response.data,
      };
    } catch (error) {
      return {
        passed: false,
        error: error.message,
        response: null,
      };
    }
  }

  private async execute2FATest(data: any): Promise<any> {
    try {
      const response = await axios.post(`${process.env.API_URL}/auth/2fa/verify`, data);
      
      return {
        passed: response.status === 200,
        error: response.status === 200 ? null : this.extractErrorMessage(response),
        response: response.data,
      };
    } catch (error) {
      return {
        passed: false,
        error: error.message,
        response: null,
      };
    }
  }

  private extractErrorMessage(response: any): string {
    if (response.data && response.data.message) {
      return response.data.message;
    }
    return 'Unknown error';
  }
}
```

#### 10.3 Validate Authorization Controls
- Test role-based access control
- Verify permission inheritance
- Test resource-based permissions
- Validate admin access controls
- Test permission escalation procedures

```typescript
// Authorization Controls Testing Service
@Injectable()
export class AuthorizationControlsTestingService {
  constructor() {}

  async testRoleBasedAccessControl(): Promise<TestResult> {
    const testCases = [
      { name: 'Valid role access', data: this.generateValidRoleTestData() },
      { name: 'Invalid role access', data: this.generateInvalidRoleTestData() },
      { name: 'Role inheritance', data: this.generateRoleInheritanceTestData() },
      { name: 'Permission escalation', data: this.generatePermissionEscalationTestData() },
    ];

    const results = [];
    for (const testCase of testCases) {
      const result = await this.executeAuthorizationTest(testCase.data);
      results.push({
        testCase: testCase.name,
        passed: result.passed,
        error: result.error,
        response: result.response,
      });
    }

    return {
      testType: 'role_based_access_control',
      totalTests: testCases.length,
      passedTests: results.filter(r => r.passed).length,
      failedTests: results.filter(r => !r.passed).length,
      results,
    };
  }

  async testResourceBasedPermissions(): Promise<TestResult> {
    const testCases = [
      { name: 'Valid permission', data: this.generateValidPermissionTestData() },
      { name: 'Invalid permission', data: this.generateInvalidPermissionTestData() },
      { name: 'Cross-resource access', data: this.generateCrossResourceTestData() },
      { name: 'Permission inheritance', data: this.generatePermissionInheritanceTestData() },
    ];

    const results = [];
    for (const testCase of testCases) {
      const result = await this.executePermissionTest(testCase.data);
      results.push({
        testCase: testCase.name,
        passed: result.passed,
        error: result.error,
        response: result.response,
      });
    }

    return {
      testType: 'resource_based_permissions',
      totalTests: testCases.length,
      passedTests: results.filter(r => r.passed).length,
      failedTests: results.filter(r => !r.passed).length,
      results,
    };
  }

  private async executeAuthorizationTest(data: any): Promise<any> {
    try {
      const response = await axios.post(`${process.env.API_URL}/test/authorization`, data);
      
      return {
        passed: response.status === 200,
        error: response.status === 200 ? null : this.extractErrorMessage(response),
        response: response.data,
      };
    } catch (error) {
      return {
        passed: false,
        error: error.message,
        response: null,
      };
    }
  }
}
```

#### 10.4 Verify Data Protection Measures
- Test data encryption at rest
- Verify secure data transmission
- Test data anonymization
- Validate GDPR compliance features
- Test data retention policies

```typescript
// Data Protection Testing Service
@Injectable()
export class DataProtectionTestingService {
  constructor() {}

  async testDataEncryption(): Promise<TestResult> {
    const testCases = [
      { name: 'Valid encryption', data: this.generateTestData() },
      { name: 'Invalid key access', data: this.generateInvalidKeyTestData() },
      { name: 'Encryption key rotation', data: this.generateKeyRotationTestData() },
    ];

    const results = [];
    for (const testCase of testCases) {
      const result = await this.executeEncryptionTest(testCase.data);
      results.push({
        testCase: testCase.name,
        passed: result.passed,
        error: result.error,
        response: result.response,
      });
    }

    return {
      testType: 'data_encryption',
      totalTests: testCases.length,
      passedTests: results.filter(r => r.passed).length,
      failedTests: results.filter(r => !r.passed).length,
      results,
    };
  }

  async testDataAnonymization(): Promise<TestResult> {
    const testCases = [
      { name: 'Valid anonymization', data: this.generateValidAnonymizationTestData() },
      { name: 'PII leakage', data: this.generatePIILeakageTestData() },
      { name: 'Reversibility', data: this.generateReversibilityTestData() },
    ];

    const results = [];
    for (const testCase of testCases) {
      const result = await this.executeAnonymizationTest(testCase.data);
      results.push({
        testCase: testCase.name,
        passed: result.passed,
        error: result.error,
        response: result.response,
      });
    }

    return {
      testType: 'data_anonymization',
      totalTests: testCases.length,
      passedTests: results.filter(r => r.passed).length,
      failedTests: results.filter(r => !r.passed).length,
      results,
    };
  }

  async testGDPRCompliance(): Promise<TestResult> {
    const testCases = [
      { name: 'Consent management', data: this.generateConsentTestData() },
      { name: 'Data portability', data: this.generateDataPortabilityTestData() },
      { name: 'Right to deletion', data: this.generateRightToDeletionTestData() },
      { name: 'Data retention', data: this.generateDataRetentionTestData() },
    ];

    const results = [];
    for (const testCase of testCases) {
      const result = await this.executeGDPRTest(testCase.data);
      results.push({
        testCase: testCase.name,
        passed: result.passed,
        error: result.error,
        response: result.response,
      });
    }

    return {
      testType: 'gdpr_compliance',
      totalTests: testCases.length,
      passedTests: results.filter(r => r.passed).length,
      failedTests: results.filter(r => !r.passed).length,
      results,
    };
  }

  private async executeEncryptionTest(data: any): Promise<any> {
    // This would test encryption/decryption functionality
    try {
      const response = await axios.post(`${process.env.API_URL}/test/encryption`, data);
      
      return {
        passed: response.status === 200,
        error: response.status === 200 ? null : this.extractErrorMessage(response),
        response: response.data,
      };
    } catch (error) {
      return {
        passed: false,
        error: error.message,
        response: null,
      };
    }
  }
}
```

#### 10.5 Create Security Documentation
- Generate comprehensive security documentation
- Create security best practices guide
- Document incident response procedures
- Create security configuration guide
- Generate security compliance report

```typescript
// Security Documentation Service
@Injectable()
export class SecurityDocumentationService {
  constructor() {}

  async generateSecurityDocumentation(): Promise<SecurityDocumentation> {
    const documentation = {
      overview: await this.generateOverview(),
      architecture: await this.generateArchitectureDocumentation(),
      authentication: await this.generateAuthenticationDocumentation(),
      authorization: await this.generateAuthorizationDocumentation(),
      dataProtection: await this.generateDataProtectionDocumentation(),
      monitoring: await this.generateMonitoringDocumentation(),
      incidentResponse: await this.generateIncidentResponseDocumentation(),
      compliance: await this.generateComplianceDocumentation(),
      bestPractices: await this.generateBestPracticesDocumentation(),
      generatedAt: new Date(),
      version: '1.0',
    };

    return documentation;
  }

  private async generateOverview(): Promise<string> {
    return `
# Saffron Sweets and Bakeries - Security Overview

This document provides a comprehensive overview of the security measures implemented in the Saffron E-Commerce Platform, designed to protect user data, prevent unauthorized access, and ensure compliance with Bangladesh data protection regulations.

## Security Architecture

The platform implements a defense-in-depth security architecture with multiple layers of protection:

1. **Authentication Layer**: JWT-based authentication with refresh tokens and two-factor authentication
2. **Authorization Layer**: Role-based access control with resource-based permissions
3. **Network Security Layer**: HTTPS enforcement, CORS configuration, and API security middleware
4. **Data Protection Layer**: Encryption at rest and in transit, data anonymization, and GDPR compliance
5. **Monitoring Layer**: Comprehensive logging, suspicious activity detection, and automated alerts

## Security Compliance

The platform is designed to comply with:
- Bangladesh Digital Security Act requirements
- General Data Protection Regulation compliance
- Industry best practices for e-commerce security
- OWASP Top 10 security controls
- PCI DSS requirements for payment processing

## Risk Assessment

### High Risk Areas
- Data breach and unauthorized access
- Payment fraud and financial data exposure
- Account takeover and privilege escalation
- Denial of service attacks
- Compliance violations and legal penalties

### Mitigation Strategies
- Regular security assessments and penetration testing
- Comprehensive monitoring and alerting systems
- Employee training and security awareness programs
- Incident response procedures and disaster recovery plans
- Regular security updates and patch management
    `;
  }

  private async generateArchitectureDocumentation(): Promise<string> {
    return `
# Security Architecture

## System Components

### Authentication System
- JWT token service with RS256 signing
- Refresh token mechanism with Redis storage
- Password hashing with bcrypt (12+ rounds)
- Two-factor authentication with TOTP and SMS backup
- Account lockout with progressive penalties

### Authorization System
- Role-based access control with 5-level hierarchy
- Resource-based permissions with fine-grained control
- Permission guards and decorators for API protection
- Admin authentication with enhanced security measures

### Data Protection System
- AES-256-GCM encryption for data at rest
- HTTPS/TLS 1.2+ for data in transit
- Data anonymization for analytics with k-anonymity
- GDPR compliance features with consent management
- Data retention policies with automatic cleanup

### Monitoring System
- Login attempt tracking with pattern analysis
- Suspicious activity detection with behavioral analysis
- Security event logging with categorization
- Automated alerting with rule engine
- Security audit trail with integrity protection
    `;
  }

  private async generateAuthenticationDocumentation(): Promise<string> {
    return `
# Authentication Implementation

## User Authentication

### Registration Process
1. **Email Registration**: Users can register with email verification
   - Email format validation with Bangladesh domain support
   - Password strength requirements (8+ chars, mixed case, numbers, special chars)
   - Account activation via email verification link (24-hour expiry)

2. **Phone Registration**: Users can register with phone verification
   - Bangladesh phone format validation (+880 or 01 prefix)
   - SMS verification via Teletalk/Robi gateways
   - 6-digit verification codes with 10-minute expiry
   - Phone number format: XXXXXXXXXX or +880XXXXXXXXX

3. **Social Login**: Integration with Google and Facebook OAuth 2.0
   - Automatic account creation for new social users
   - Account linking for existing users
   - Profile mapping from social providers

### Login Process
1. **Standard Login**: Email/phone with password
   - Rate limiting: 5 attempts per 15 minutes
   - Account lockout: Progressive penalties (5min to 24hr)
   - Session management: 8-hour timeout with Redis

2. **Two-Factor Authentication**: Optional but recommended for admin users
   - TOTP with 6-digit codes (30-second window)
   - SMS backup codes (10 codes, 24-hour expiry)
   - QR code setup for mobile apps

3. **Password Reset**: Secure token-based reset
   - Reset tokens: UUID with 1-hour expiry
   - Email/SMS delivery of reset links
   - Password history tracking (last 12 passwords)
   - Password strength validation during reset

### Security Features
- **Session Security**: JWT blacklisting on logout
- **Account Protection**: Failed login tracking and IP blocking
- **Device Management**: Device tracking and session invalidation
- **Admin Authentication**: Enhanced security with mandatory 2FA
- **Password Policies**: 12-character minimum for admin users, 90-day expiry
    `;
  }

  private async generateAuthorizationDocumentation(): Promise<string> {
    return `
# Authorization Implementation

## Role-Based Access Control

### Role Hierarchy
1. **Super Admin**: Full system access and user management
2. **Admin**: Product and order management, user support
3. **Moderator**: Content moderation and review management
4. **Support**: Customer service and order management
5. **Analyst**: Analytics and reporting access

### Permission System
- **Format**: resource:action (e.g., user:create, product:read)
- **Categories**: User Management, Product Management, Order Management, System Administration
- **Inheritance**: Child roles inherit parent permissions
- **Dynamic Assignment**: Runtime permission assignment and validation
- **Audit Trail**: All permission changes logged with timestamps

### Access Control Implementation
- **Guards**: Permission-based route protection
- **Decorators**: Easy permission requirement specification
- **Middleware**: Automatic permission checking and enforcement
- **Caching**: Redis-based permission caching for performance
- **Admin Panel**: Enhanced security with role verification
    `;
  }

  private async generateDataProtectionDocumentation(): Promise<string> {
    return `
# Data Protection Implementation

## Encryption Standards
- **Algorithm**: AES-256-GCM for symmetric encryption
- **Key Management**: 90-day rotation with secure storage
- **Hashing**: bcrypt with 12+ salt rounds for passwords
- **Transport**: TLS 1.2+ with perfect forward secrecy

## Data at Rest
- **Database**: Field-level encryption for sensitive data
- **File Storage**: Server-side encryption before storage
- **Key Management**: HSM or secure key vault integration
- **Access Control**: Role-based decryption key access

## Data in Transit
- **API Communication**: HTTPS-only with certificate validation
- **Email/SMS**: TLS encryption for message content
- **File Upload**: Encrypted multipart uploads
- **WebSockets**: Secure WebSocket connections with TLS

## Privacy Features
- **Data Minimization**: Collect only necessary personal information
- **Anonymization**: K-anonymity (k=1000) for analytics data
- **Consent Management**: Granular consent for data processing
- **Data Portability**: Standardized export formats (JSON, CSV)
- **Right to Deletion**: Complete data removal with 30-day grace period

## Compliance Framework
- **GDPR**: Full compliance with consent management and data protection officer
- **Bangladesh Regulations**: Local data residency and compliance requirements
- **PCI DSS**: Payment card industry standards compliance
- **Audit Requirements**: Comprehensive logging and reporting capabilities
    `;
  }

  private async generateMonitoringDocumentation(): Promise<string> {
    return `
# Security Monitoring Implementation

## Login Attempt Tracking
- **Metrics Collection**: Success/failure rates by IP, time, and user
- **Pattern Analysis**: Geographic anomalies, rapid succession, unusual access times
- **Alert Thresholds**: Configurable triggers for different risk levels
- **Retention**: 90-day active logs, 1-year archive for audit trail

## Suspicious Activity Detection
- **Behavioral Analysis**: Machine learning-based anomaly detection
- **Risk Scoring**: 0-10 scale with automated escalation
- **Pattern Recognition**: Known attack patterns and zero-day vulnerability detection
- **Geographic Analysis**: Location-based access pattern analysis
- **Device Fingerprinting**: Browser and device tracking for fraud prevention

## Security Event Logging
- **Categorization**: Authentication, authorization, data access, system changes
- **Severity Levels**: Critical, High, Medium, Low with different response times
- **Correlation**: Event linking for attack chain reconstruction
- **Retention Policies**: Configurable based on event type and compliance requirements
    `;
  }

  private async generateBestPracticesDocumentation(): Promise<string> {
    return `
# Security Best Practices

## Development Guidelines
- **Secure Coding**: OWASP Top 10 compliance, input validation, output encoding
- **Code Review**: Peer review and static analysis for security issues
- **Dependency Management**: Regular updates and vulnerability scanning
- **Testing**: Automated security testing in CI/CD pipeline

## Operational Guidelines
- **Access Control**: Principle of least privilege, regular permission audits
- **Password Policy**: Complexity requirements, regular changes, no password reuse
- **Incident Response**: Predefined procedures for different incident types
- **Monitoring**: 24/7 security monitoring with automated alerting
- **Training**: Regular security awareness and phishing prevention training

## Bangladesh-Specific Considerations
- **Mobile Security**: SMS-based authentication, USSD support, offline capability
- **Local Compliance**: Data residency requirements, local privacy laws
- **Cultural Adaptation**: Bengali language support, local payment method integration
- **Network Optimization**: Low-bandwidth optimization for mobile networks
- **Emergency Response**: Local incident response procedures and contacts
    `;
  }

  async generateComplianceDocumentation(): Promise<string> {
    return `
# Compliance Documentation

## Regulatory Compliance
- **Bangladesh Digital Security Act**: Local implementation requirements
- **Data Protection Act**: Personal data protection and privacy requirements
- **Payment Regulations**: Local payment method compliance and reporting
- **Telecommunications Regulations**: SMS gateway compliance and usage reporting

## Compliance Implementation
- **Data Residency**: All user data stored within Bangladesh borders
- **Consent Management**: Granular consent for different data processing activities
- **Data Subject Rights**: Access, rectification, erasure, and portability rights
- **Breach Notification**: 72-hour notification requirement for data breaches
- **Audit Requirements**: Comprehensive logging and 5-year record retention
- **DPO Appointment**: Data protection officer designation and contact information

## Security Metrics
- **Compliance Score**: Regular assessment against regulatory requirements
- **Risk Metrics**: Quantified risk assessment and mitigation tracking
- **Incident Metrics**: Response time, resolution rate, and recurrence measurement
- **Training Metrics**: Employee awareness and phishing test results
- **Audit Metrics**: Coverage, effectiveness, and compliance rate measurements
    `;
  }
}
```

### Acceptance Criteria for Validation
- Security penetration testing completed with vulnerability assessment and remediation tracking
- Authentication flows verified with comprehensive test coverage
- Authorization controls validated with role hierarchy and permission testing
- Data protection measures verified with encryption, transmission, and anonymization testing
- Security documentation created with comprehensive coverage and best practices
- All security measures compliant with Bangladesh regulations and industry standards

### Estimated Completion Time
- **Total Duration:** 1 day
- **Security Penetration Testing:** 3 hours
- **Authentication Flows Verification:** 2 hours
- **Authorization Controls Validation:** 2 hours
- **Data Protection Measures Verification:** 2 hours
- **Security Documentation Creation:** 3 hours
- **Testing and Validation:** 2 hours

### Required Resources
- Security testing tools and frameworks
- Vulnerability scanning services
- Documentation generation tools
- Compliance assessment frameworks
- Security incident response procedures

### Validation Checkpoints and Testing Procedures
- Test penetration testing with various attack vectors and vulnerability assessments
- Verify authentication flows with different user scenarios and edge cases
- Test authorization controls with various roles and permission combinations
- Validate data protection measures with encryption, transmission, and anonymization testing
- Review security documentation for completeness and accuracy

### Technical Specifications
- **Penetration Testing:** OWASP Top 10 coverage with automated and manual testing
- **Authentication Testing:** Complete flow coverage including edge cases and error scenarios
- **Authorization Testing:** Role hierarchy validation and permission boundary testing
- **Data Protection Testing:** Encryption validation, transmission security, and anonymization verification
- **Documentation:** Comprehensive coverage with architecture, implementation, and compliance sections

---

## CONCLUSION

This comprehensive Phase 4 implementation guide provides a structured approach to authentication and security implementation for the Saffron Sweets and Bakeries E-Commerce Platform. The ten sequential milestones cover all aspects of security development from basic authentication through comprehensive verification and documentation.

Each milestone includes detailed implementation steps, acceptance criteria, and validation procedures to ensure high-quality security development. The design specifically addresses Bangladesh-specific requirements including mobile-first authentication, local SMS gateway integration, and compliance with Bangladesh data protection regulations.

Upon completion of Phase 4, the platform will have a robust, secure, and compliant authentication and security system ready to support all subsequent phases of development while maintaining user trust and regulatory compliance.

---

**Document Prepared By:** Security Architecture Team  
**Document Date:** January 16, 2026  
**Version:** 1.0  
**Status:** Ready for Implementation  
**Next Steps:** Begin Milestone 1 implementation