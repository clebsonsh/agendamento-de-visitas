.PHONY: dev-backend dev-frontend lint-backend lint-frontend test-backend test-frontend ci-backend ci-frontend

# Backend
dev-backend:
	cd backend && composer dev

lint-backend:
	cd backend && composer pint && composer phpstan

test-backend:
	cd backend && composer pest

ci-backend: lint-backend test-backend

# Frontend
dev-frontend:
	cd frontend && npm run dev

lint-frontend:
	cd frontend && npm run lint

test-frontend:
	cd frontend && npm run build

ci-frontend: lint-frontend test-frontend

# All
ci: ci-backend ci-frontend
