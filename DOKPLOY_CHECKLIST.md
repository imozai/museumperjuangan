# Dokploy Deployment Checklist

Checklist lengkap untuk mempersiapkan dan melakukan deployment Museum Perjuangan ke Dokploy.

## Pre-Deployment Checklist

### Repository Setup
- [ ] Repository sudah di Git (GitHub, GitLab, Gitea, dll)
- [ ] `.env` TIDAK ter-commit (sudah di .gitignore)
- [ ] `.env.example` ada dan ter-commit
- [ ] `Dockerfile` sudah optimized (multi-stage build)
- [ ] `docker-compose.prod.yml` ada
- [ ] `.dockerignore` proper configured
- [ ] `composer.lock` updated dan ter-commit
- [ ] `package-lock.json` atau `yarn.lock` updated (jika ada)
- [ ] All changes committed dan pushed ke main branch

### Dokploy Server Setup
- [ ] Dokploy sudah terinstall di server
- [ ] Docker dan Docker Compose sudah terinstall
- [ ] Server memiliki:
  - [ ] Minimal 2GB RAM
  - [ ] Minimal 20GB disk space
  - [ ] Internet connection stabil
- [ ] Akses SSH ke Dokploy server
- [ ] Akses dashboard Dokploy
- [ ] Domain/subdomain sudah disiapkan
- [ ] DNS pointed ke Dokploy server IP

### Local Testing
- [ ] Build Dockerfile lokal: `docker build -t test .`
- [ ] Test environment variables di `.env.local`
- [ ] Database migrations tested: `php artisan migrate`
- [ ] Seeding tested: `php artisan db:seed` (opsional)
- [ ] Storage link tested: `php artisan storage:link`
- [ ] Tests passed: `php artisan test`

---

## Dokploy Dashboard Setup

### Step 1: Project Creation
- [ ] Create new project: `museum-perjuangan`
- [ ] Set description
- [ ] Save project

### Step 2: Repository Connection
- [ ] Connect to Git repository
- [ ] Select correct branch (main/master)
- [ ] Verify repository access working
- [ ] Test repository webhook

### Step 3: Application Service (app)
- [ ] Service name: `app`
- [ ] Domain: `yourdomain.com` (tanpa https://)
- [ ] Dockerfile path: `./Dockerfile`
- [ ] Build context: `./`
- [ ] Container port: `80`
- [ ] Published port: `80` atau `8000`

#### Environment Variables:
- [ ] `APP_NAME="Museum Perjuangan"`
- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_KEY=base64:YOUR_KEY` (from `php artisan key:generate --show`)
- [ ] `APP_URL=https://yourdomain.com`
- [ ] `DB_HOST=db`
- [ ] `DB_DATABASE=museumperjuangan`
- [ ] `DB_USERNAME=laravel`
- [ ] `DB_PASSWORD=YOUR_SECURE_PASSWORD`
- [ ] `CACHE_DRIVER=file`
- [ ] `QUEUE_CONNECTION=sync`
- [ ] `SESSION_DRIVER=file`
- [ ] `MAIL_DRIVER=smtp`
- [ ] `MAIL_HOST=smtp.gmail.com` (atau mail server lainnya)
- [ ] `MAIL_PORT=587`
- [ ] `MAIL_USERNAME=your-email@gmail.com`
- [ ] `MAIL_PASSWORD=app-specific-password`
- [ ] `MAIL_ENCRYPTION=tls`
- [ ] `MAIL_FROM_ADDRESS=noreply@yourdomain.com`

#### Advanced Settings:
- [ ] Auto Deploy: Enabled (untuk auto deploy saat push)
- [ ] Restart Policy: `unless-stopped`
- [ ] Memory Limit: `512M` (atau sesuai kebutuhan)
- [ ] CPU Limit: `0.5` (atau sesuai kebutuhan)

### Step 4: Database Service (db)
- [ ] Service name: `db`
- [ ] Database type: `MySQL`
- [ ] Version: `8.0`
- [ ] Root password: Generated (strong)
- [ ] Database name: `museumperjuangan`
- [ ] User: `laravel`
- [ ] User password: Generated (strong)
- [ ] Memory limit: `256M`
- [ ] Store connection credentials securely

### Step 5: SSL Configuration
- [ ] Domain configured in service
- [ ] SSL certificate: Let's Encrypt (auto)
- [ ] Certificate auto-renew: Enabled
- [ ] HTTPS redirect: Enabled

---

## First Deployment

### Pre-Deployment
- [ ] All checklist items above completed
- [ ] Environment variables double-checked
- [ ] Database credentials noted
- [ ] Admin user credentials prepared

### Deploy
- [ ] Click "Deploy" button di service app
- [ ] Monitor logs: `docker logs -f museumperjuangan_app`
- [ ] Wait for deployment complete (may take 5-10 minutes)
- [ ] Check health status di Dokploy dashboard
- [ ] Verify no error in logs

### Post-Deployment
- [ ] Access application via https://yourdomain.com
- [ ] Verify page loads correctly
- [ ] Check storage link working
- [ ] Verify database connection working

---

## Post-Deployment Configuration

### Run Migrations & Setup
- [ ] SSH ke Dokploy server
- [ ] Run: `docker exec museumperjuangan_app php artisan migrate --force`
- [ ] Run: `docker exec museumperjuangan_app php artisan db:seed --force` (jika needed)
- [ ] Run: `docker exec museumperjuangan_app php artisan storage:link`
- [ ] Generate APP_KEY: `docker exec museumperjuangan_app php artisan key:generate --show`

### Cache Configuration
- [ ] Run: `docker exec museumperjuangan_app php artisan config:cache`
- [ ] Run: `docker exec museumperjuangan_app php artisan route:cache`
- [ ] Run: `docker exec museumperjuangan_app php artisan view:cache`
- [ ] Run: `docker exec museumperjuangan_app php artisan optimize`

### Create Admin User
- [ ] SSH ke container: `docker exec -it museumperjuangan_app bash`
- [ ] Run: `php artisan tinker`
- [ ] Create user dengan credentials yang aman
- [ ] Assign admin role/permissions

### Application Testing
- [ ] Homepage loads
- [ ] Database queries working
- [ ] Login functionality working
- [ ] File uploads working (storage link)
- [ ] Email sending tested
- [ ] Admin panel accessible
- [ ] All main features tested

---

## Ongoing Monitoring

### Daily
- [ ] Check application health in Dokploy
- [ ] Monitor logs for errors
- [ ] Check disk space usage
- [ ] Verify backups completed

### Weekly
- [ ] Review logs for patterns
- [ ] Check database size
- [ ] Verify SSL certificate valid
- [ ] Test disaster recovery

### Monthly
- [ ] Update dependencies: `composer update`
- [ ] Database maintenance (OPTIMIZE TABLE)
- [ ] Review security settings
- [ ] Full system backup

---

## Update & Redeploy Process

### For Minor Updates
```bash
# Local
git commit -am "Update"
git push origin main

# Dokploy auto-deploys if enabled
# Or click "Deploy" manually
# Monitor logs
```

### For Major Updates
```bash
# Local - backup first
mysqldump -u user -p database > backup.sql
git commit -am "Major update"
git push origin main

# Dokploy
# Monitor deployment
# Test thoroughly
# Ready to rollback if needed
```

### Rollback Procedure
- [ ] Go to Deployments history
- [ ] Select previous working deployment
- [ ] Click "Rollback"
- [ ] Verify application working
- [ ] Check logs

---

## Backup & Disaster Recovery

### Database Backups
- [ ] Weekly: Automated backup to external storage
- [ ] Monthly: Full backup + test restore
- [ ] Quarterly: Archive backups off-site
- [ ] Procedure documented: [Location]

### File Backups
- [ ] Upload directory backed up
- [ ] Storage directory backed up
- [ ] Config files backed up
- [ ] Logs backed up (if needed)

### Recovery Testing
- [ ] Monthly: Test database restore
- [ ] Quarterly: Full application recovery test
- [ ] Recovery time measured
- [ ] Documentation updated

---

## Security Checklist

### Application Security
- [ ] APP_DEBUG = false
- [ ] APP_ENV = production
- [ ] All credentials in environment variables
- [ ] No credentials in code
- [ ] Laravel security headers enabled

### Server Security
- [ ] SSH key-based authentication
- [ ] Firewall configured
- [ ] Only necessary ports open (80, 443)
- [ ] Fail2ban or similar configured
- [ ] Regular security updates

### Database Security
- [ ] Strong passwords set
- [ ] Database not accessible from internet
- [ ] Backups encrypted
- [ ] SQL injection prevention (Laravel ORM)
- [ ] Database user permissions minimal

### Application-Level
- [ ] CSRF protection enabled
- [ ] XSS protection configured
- [ ] SQL injection prevention
- [ ] Rate limiting configured
- [ ] Admin panel password strong
- [ ] 2FA enabled (if available)

---

## Documentation

### Required Documentation
- [ ] Deployment procedure documented
- [ ] Environment variables documented
- [ ] Database schema documented
- [ ] Admin user creation documented
- [ ] Backup/restore procedure documented
- [ ] Troubleshooting guide created

### Optional but Recommended
- [ ] Architecture diagram
- [ ] Disaster recovery plan
- [ ] Performance tuning guide
- [ ] Scaling strategy
- [ ] Monitoring alerting setup

---

## Performance Optimization

### Caching
- [ ] Config cache enabled
- [ ] Route cache enabled
- [ ] View cache enabled
- [ ] Query optimization done
- [ ] Database indexes created

### Monitoring
- [ ] CPU usage monitored
- [ ] Memory usage monitored
- [ ] Disk space monitored
- [ ] Database performance monitored
- [ ] Response times logged

### Optimization
- [ ] OPCache enabled (in Dockerfile)
- [ ] Gzip compression enabled
- [ ] Database queries optimized
- [ ] Asset compression configured
- [ ] CDN configured (if needed)

---

## Common Issues & Solutions

| Issue | Solution |
|-------|----------|
| "Database connection refused" | Check DB_HOST=db, restart db service |
| "Permission denied" storage | Run: `docker exec app chown -R www-data:www-data .` |
| "Application key is missing" | Set APP_KEY in environment variables |
| "Port already in use" | Change port in Dokploy settings |
| "SSL certificate error" | Check domain in service settings, restart service |
| "High memory usage" | Check logs, increase memory limit, optimize code |
| "Build failed" | Check Dockerfile, check logs, rebuild with --no-cache |

---

## Resources

- Dokploy Docs: https://dokploy.com/docs
- Laravel Deployment: https://laravel.com/docs/deployment
- Docker: https://docs.docker.com/
- Docker Compose: https://docs.docker.com/compose/

---

## Sign-Off

- [ ] Deployment completed successfully
- [ ] All tests passed
- [ ] Monitoring setup complete
- [ ] Documentation completed
- [ ] Team trained on deployment process
- [ ] Production environment ready

**Deployed by**: ________________  
**Date**: ________________  
**Version**: ________________  
**Notes**: _________________________________________________

---

**For questions or issues, refer to DOKPLOY.md or SETUP.md**
